<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;

use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authenticated Defaults
|--------------------------------------------------------------------------
*/

Route::redirect('/home', '/dashboard')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes (Owner Admin only)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/users', [UserManagementController::class, 'index'])
            ->name('users.index');

        Route::get('/users/create', [UserManagementController::class, 'create'])
            ->name('users.create');

        Route::post('/users', [UserManagementController::class, 'store'])
            ->name('users.store');

        Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{user}', [UserManagementController::class, 'update'])
            ->name('users.update');

        Route::put('/users/{user}/reset-password', [UserManagementController::class, 'resetPassword'])
            ->name('users.reset_password');

        Route::put('/users/{user}/toggle-active', [UserManagementController::class, 'toggleActive'])
            ->name('users.toggle_active');
    });

/*
|--------------------------------------------------------------------------
| App Routes (authenticated)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Profile (Breeze)
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Master Data V1 (role protected)
    |--------------------------------------------------------------------------
    */

    // Employees (Admin only)
    Route::middleware('role:Owner Admin')->group(function () {
        Route::resource('employees', EmployeeController::class);
    });

    // Items and Suppliers (Admin + Inventory)
    Route::middleware('role:Owner Admin|Inventory Stock Custodian')->group(function () {
        Route::resource('items', ItemController::class);
        Route::resource('suppliers', SupplierController::class);
    });

    // Customers (Admin + Cashier + Accountant)
    Route::middleware('role:Owner Admin|Sales Cashier|Accountant Bookkeeper')->group(function () {
        Route::resource('customers', CustomerController::class);
    });
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
