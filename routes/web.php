<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

// Landing page (marketing + login)
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Attendance entry page (QR / future expansion)
Route::get('/attendance', function () {
    return view('attendance.index');
})->name('attendance');


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Authenticated User Pages
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Auth Routes (Login, Logout, Forgot Password only)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
