<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\ReturnController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'loginWeb'])->name('login.post');

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'sendOtp'])->name('send.otp');

Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.form');
Route::post('/reset-password', [AuthController::class, 'verifyOtpAndResetPassword'])->name('reset.password');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    if (auth()->user()->role == 'admin') {
        return redirect('/admin/dashboard');
    }

    return redirect('/user/dashboard');

})->middleware('auth');

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:user'])->group(function () {

    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    });

    Route::get('/my-borrowings', [BorrowingController::class,'index']);
    Route::post('/borrow', [BorrowingController::class,'store']);

});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    // 🔥 TAMBAH SISWA (REGISTER KHUSUS ADMIN)
    Route::get('/admin/users/create', function () {
        return view('admin.users.create'); // halaman form tambah siswa
    })->name('admin.users.create');

    Route::post('/admin/users/store', [AuthController::class, 'storeUser'])
        ->name('admin.users.store');

    Route::post('/return', [ReturnController::class,'store']);

});