<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->user()->role ?? null;

        if ($role === 'seller') {
            return redirect()->route('seller.dashboard');
        }

        if ($role === 'buyer') {
            return redirect()->route('shop');
        }

        return redirect()->route('home');
    }
}
