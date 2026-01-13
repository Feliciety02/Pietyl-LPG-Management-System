<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin(Request $request)
    {
        return view('admin.dashboard');
    }

    public function accountant(Request $request)
    {
        return view('accountant.dashboard');
    }

    public function cashier(Request $request)
    {
        return view('cashier.dashboard');
    }

    public function inventory(Request $request)
    {
        return view('inventory_manager.dashboard');
    }

    public function delivery(Request $request)
    {
        return view('delivery_rider.dashboard');
    }
}
