<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Classes;
use App\Models\Major;

class AuthController extends Controller
{
    /**
     * =========================
     * TAMBAH USER (OLEH ADMIN)
     * =========================
     */
    public function storeUser(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',

            'kelas' => 'required|exists:classes,name',
            'jurusan' => 'required|exists:majors,name',
            'nisn' => 'required|string|unique:users,nisn',
        ]);

        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => 'user',

            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'nisn' => $request->nisn,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function create()
    {
        $classes = Classes::all();
        $majors = Major::all();

        return view('users.create', compact('classes', 'majors'));
    }

    /**
     * =========================
     * LOGIN (USERNAME / NISN)
     * =========================
     */
    public function loginWeb(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        // 1. Coba login sebagai ADMIN (pakai username)
        $adminLogin = Auth::attempt([
            'username' => $request->login,
            'password' => $request->password,
            'role' => 'admin'
        ]);

        if ($adminLogin) {
            $request->session()->regenerate();
            return redirect('/admin/dashboard');
        }

        // 2. Coba login sebagai SISWA (pakai NISN)
        $userLogin = Auth::attempt([
            'nisn' => $request->login,
            'password' => $request->password,
            'role' => 'user'
        ]);

        if ($userLogin) {
            $request->session()->regenerate();
            return redirect('/user/dashboard');
        }

        // 3. Kalau gagal semua
        return back()->withErrors([
            'login' => 'Login gagal! Periksa username / NISN dan password.',
        ])->withInput();
    }

    /**
     * =========================
     * RESET PASSWORD TANPA EMAIL
     * =========================
     */
    public function showResetPasswordForm()
    {
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'login' => 'required', // username / nisn
            'password' => 'required|string|min:6|confirmed',
        ]);

        $field = is_numeric($request->login) ? 'nisn' : 'username';

        $user = User::where($field, $request->login)->first();

        if (!$user) {
            return back()->withErrors([
                'login' => 'User tidak ditemukan.'
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')
            ->with('success', 'Password berhasil diubah.');
    }

    /**
     * =========================
     * LOGOUT
     * =========================
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Berhasil logout');
    }
}