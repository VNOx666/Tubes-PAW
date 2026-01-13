<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $newDrops = Product::query()
            ->with('seller')
            ->where('status', 'active')
            ->latest()
            ->take(8)
            ->get();

        return view('pages.home', compact('newDrops'));
    }
}
