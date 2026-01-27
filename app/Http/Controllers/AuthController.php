<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * PROSES REGISTER (WEB)
     */
    public function registerWeb(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    /**
     * PROSES LOGIN (WEB)
     */
    public function loginWeb(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // FORM LUPA PASSWORD
    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    // KIRIM OTP KE EMAIL
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak ditemukan.',
        ]);

        $user = User::where('email', $request->email)->first();

        // Generate OTP 6 digit
        $otp = rand(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expired_at' => Carbon::now()->addMinutes(10),
        ]);

        // Kirim email OTP
        Mail::raw("Kode verifikasi reset password Anda: $otp", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Kode OTP Reset Password');
        });

        return redirect()->route('reset.password.form')->with('email', $user->email)
                         ->with('success', 'Kode OTP sudah dikirim ke email Anda.');
    }

    // FORM RESET PASSWORD + OTP
    public function showResetPasswordForm(Request $request)
    {
        $email = session('email'); // email dari step sebelumnya
        return view('auth.reset-password', compact('email'));
    }

    // VERIFIKASI OTP & RESET PASSWORD
    public function verifyOtpAndResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }

        if (Carbon::now()->gt($user->otp_expired_at)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kadaluarsa.']);
        }

        // Reset password
        $user->update([
            'password' => bcrypt($request->password),
            'otp' => null,
            'otp_expired_at' => null,
        ]);

        return redirect('/login')->with('success', 'Password berhasil diubah, silakan login.');
    }

    /**
     * LOGOUT (WEB)
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
