<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {

    Route::view('/dashboard/admin', 'dashboards.admin')
        ->middleware('role:Owner Admin');

    Route::view('/dashboard/accountant', 'dashboards.accountant')
        ->middleware('role:Accountant Bookkeeper');

    Route::view('/dashboard/cashier', 'dashboards.cashier')
        ->middleware('role:Sales Cashier');

    Route::view('/dashboard/inventory', 'dashboards.inventory')
        ->middleware('role:Inventory Stock Custodian');

    Route::view('/dashboard/rider', 'dashboards.rider')
        ->middleware('role:Delivery Rider Driver');

});
