<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'seller') {
            return redirect()->route('seller.dashboard');
        }

        // buyer arahkan ke halaman home/shop kamu
        return redirect()->route('home');
    }
}
