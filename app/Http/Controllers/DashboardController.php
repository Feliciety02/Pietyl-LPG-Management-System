<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin(Request $request)
    {
        return view('dashboards.admin');
    }

    public function accountant(Request $request)
    {
        return view('dashboards.accountant');
    }

    public function cashier(Request $request)
    {
        return view('dashboards.cashier');
    }

    public function inventory(Request $request)
    {
        return view('dashboards.inventory');
    }

    public function delivery(Request $request)
    {
        return view('dashboards.delivery');
    }
}
