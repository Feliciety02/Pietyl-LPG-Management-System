<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Master Data V1 with Role Protection
    |--------------------------------------------------------------------------
    */

    // Employees
    Route::middleware(['role:Owner Admin'])->group(function () {
        Route::resource('employees', EmployeeController::class);
    });

    // Items and Suppliers
    Route::middleware(['role:Owner Admin|Inventory Stock Custodian'])->group(function () {
        Route::resource('items', ItemController::class);
        Route::resource('suppliers', SupplierController::class);
    });

    // Customers
    Route::middleware(['role:Owner Admin|Sales Cashier|Accountant Bookkeeper'])->group(function () {
        Route::resource('customers', CustomerController::class);
    });
});

require __DIR__ . '/auth.php';
