<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/attendance', function () {
    return view('attendance');
})->name('attendance');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
| Breeze or Jetstream will register login, logout, password reset routes here.
| Make sure routes/auth.php exists.
|
| If you do not have Breeze installed, the require line will error.
| In that case, set your landing links to "/login" temporarily or install Breeze.
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
*/

Route::middleware(['auth', 'role:Owner Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    });

Route::middleware(['auth', 'role:Accountant Bookkeeper'])
    ->prefix('accountant')
    ->name('accountant.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'accountant'])->name('dashboard');
    });

Route::middleware(['auth', 'role:Sales Cashier'])
    ->prefix('cashier')
    ->name('cashier.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'cashier'])->name('dashboard');
    });

Route::middleware(['auth', 'role:Inventory Stock Custodian'])
    ->prefix('inventory')
    ->name('inventory.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'inventory'])->name('dashboard');
    });

Route::middleware(['auth', 'role:Delivery Rider Driver'])
    ->prefix('delivery')
    ->name('delivery.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'delivery'])->name('dashboard');
    });
