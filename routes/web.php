<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::view('/', 'landing')->name('landing');
Route::view('/attendance', 'attendance')->name('attendance');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| AUTHENTICATED DEFAULTS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        $user = request()->user();

        if ($user->hasRole('Owner Admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('Accountant Bookkeeper')) {
            return redirect()->route('accountant.dashboard');
        }

        if ($user->hasRole('Sales Cashier')) {
            return redirect()->route('cashier.dashboard');
        }

        if ($user->hasRole('Inventory Stock Custodian')) {
            return redirect()->route('inventory.dashboard');
        }

        if ($user->hasRole('Delivery Rider Driver')) {
            return redirect()->route('delivery.dashboard');
        }

        abort(403);
    })->name('home');

    Route::get('/dashboard', fn () => redirect()->route('home'))
        ->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| ROLE ROUTES
|--------------------------------------------------------------------------
| Each role owns its own area. Dashboards are entry points.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:Owner Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'admin'])
            ->name('dashboard');

        // Employees CRUD (admin only)
        
        Route::get('/employees', [EmployeeController::class, 'index'])
            ->name('employees.index');

        Route::resource('employees', EmployeeController::class)
            ->except(['index'])
            ->names('employees');

        // Users (placeholder)
        Route::view('/users', 'admin.users.index')
            ->name('users.index');

        // Settings (placeholder)
        Route::view('/settings', 'admin.settings.index')
            ->name('settings.index');
    });

Route::middleware(['auth', 'role:Accountant Bookkeeper'])
    ->prefix('accountant')
    ->name('accountant.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'accountant'])->name('dashboard');
        Route::view('/reports', 'accountant.reports.index')->name('reports.index');
    });

Route::middleware(['auth', 'role:Sales Cashier'])
    ->prefix('cashier')
    ->name('cashier.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'cashier'])->name('dashboard');
        Route::view('/sales', 'cashier.sales.index')->name('sales.index');
        Route::view('/customers', 'cashier.customers.index')->name('customers.index');
    });

Route::middleware(['auth', 'role:Inventory Stock Custodian|Owner Admin'])
    ->prefix('inventory')
    ->name('inventory.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'inventory'])->name('dashboard');
        Route::view('/items', 'inventory.items.index')->name('items.index');
        Route::view('/suppliers', 'inventory.suppliers.index')->name('suppliers.index');
        Route::view('/stock-movements', 'inventory.stock-movements.index')->name('stock-movements.index');
    });

Route::middleware(['auth', 'role:Delivery Rider Driver'])
    ->prefix('delivery')
    ->name('delivery.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'delivery'])->name('dashboard');
        Route::view('/deliveries', 'delivery.deliveries.index')->name('deliveries.index');
    });

/*
|--------------------------------------------------------------------------
| LEGACY SHORTCUTS (OPTIONAL)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:Inventory Stock Custodian|Owner Admin'])
    ->group(function () {
        Route::get('/items', fn () => redirect()->route('inventory.items.index'))->name('items.index');
        Route::get('/suppliers', fn () => redirect()->route('inventory.suppliers.index'))->name('suppliers.index');
    });

Route::middleware(['auth', 'role:Owner Admin|Sales Cashier|Accountant Bookkeeper'])
    ->get('/customers', fn () => view('customers.index'))
    ->name('customers.index');
