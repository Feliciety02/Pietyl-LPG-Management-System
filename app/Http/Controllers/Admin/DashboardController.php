<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $inactiveUsers = User::where('is_active', false)->count();

        $rolesCount = [
            'Owner Admin' => User::role('Owner Admin')->count(),
            'Accountant Bookkeeper' => User::role('Accountant Bookkeeper')->count(),
            'Sales Cashier' => User::role('Sales Cashier')->count(),
            'Inventory Stock Custodian' => User::role('Inventory Stock Custodian')->count(),
            'Delivery Rider Driver' => User::role('Delivery Rider Driver')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeUsers',
            'inactiveUsers',
            'rolesCount'
        ));
    }
}
