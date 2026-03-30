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
     * =========================
     * TAMBAH USER (OLEH ADMIN)
     * =========================
     */
    public function storeUser(Request $request)
    {
        // hanya admin yang boleh
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',

            // khusus siswa
            'kelas' => 'required|string',
            'jurusan' => 'required|string',
            'nipd' => 'required|string|unique:users,nipd',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'kelas.required' => 'Kelas wajib diisi.',
            'jurusan.required' => 'Jurusan wajib diisi.',
            'nipd.required' => 'NIPD wajib diisi.',
            'nipd.unique' => 'NIPD sudah digunakan.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',

            // data siswa
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'nipd' => $request->nipd,
        ]);

        return redirect()->back()->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * =========================
     * LOGIN (WEB)
     * =========================
     */
    public function loginWeb(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            return redirect('/user/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * =========================
     * FORM LUPA PASSWORD
     * =========================
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    /**
     * =========================
     * KIRIM OTP
     * =========================
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak ditemukan.',
        ]);

        $user = User::where('email', $request->email)->first();

        // generate OTP
        $otp = rand(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expired_at' => Carbon::now()->addMinutes(10),
        ]);

        // kirim email
        Mail::raw("Kode verifikasi reset password Anda: $otp", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Kode OTP Reset Password');
        });

        return redirect()->route('reset.password.form')
            ->with('email', $user->email)
            ->with('success', 'Kode OTP sudah dikirim ke email Anda.');
    }

    /**
     * =========================
     * FORM RESET PASSWORD
     * =========================
     */
    public function showResetPasswordForm(Request $request)
    {
        $email = session('email');
        return view('auth.reset-password', compact('email'));
    }

    /**
     * =========================
     * VERIFIKASI OTP & RESET
     * =========================
     */
    public function verifyOtpAndResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp != $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }

        if (Carbon::now()->gt($user->otp_expired_at)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kadaluarsa.']);
        }

        // reset password
        $user->update([
            'password' => Hash::make($request->password),
            'otp' => null,
            'otp_expired_at' => null,
        ]);

        return redirect('/login')->with('success', 'Password berhasil diubah, silakan login.');
    }

    /**
     * =========================
     * LOGOUT
     * =========================
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}