<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\MajorController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// LOGIN
Route::get('/login', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'loginWeb'])->name('login.post');

// FORGOT PASSWORD
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'sendOtp'])->name('send.otp');

// RESET PASSWORD
Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.form');
Route::post('/reset-password', [AuthController::class, 'verifyOtpAndResetPassword'])->name('reset.password');

// LOGOUT
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
        return view('users.dashboard');
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

    // DASHBOARD
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | USERS (SISWA)
    |--------------------------------------------------------------------------
    */

    // HALAMAN TABEL SISWA
    Route::get('/admin/users', function () {
        $users = User::where('role', 'user')->get();
        return view('users.index', compact('users'));
    })->name('users.index');
    
    Route::get('/admin/users/create', function () {
    return view('users.create');
        })->name('users.create');
        
    // TAMBAH SISWA (DARI MODAL)
    Route::post('/admin/users', [AuthController::class, 'storeUser'])
        ->name('users.store');
    
    Route::get('/admin/users/create', [AuthController::class, 'create'])->name('users.create');

    /*
    |--------------------------------------------------------------------------
    | RETURN
    |--------------------------------------------------------------------------
    */

    Route::post('/return', [ReturnController::class,'store']);


    /*
    |--------------------------------------------------------------------------
    | MASTER DATA
    |--------------------------------------------------------------------------
    */

    Route::resource('books', BookController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubcategoryController::class);
    Route::resource('classes', ClassesController::class);
    Route::resource('majors', MajorController::class);
});