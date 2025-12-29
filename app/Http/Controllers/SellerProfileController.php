<?php

namespace App\Http\Controllers;

use App\Models\User;

class SellerProfileController extends Controller
{
    public function show(User $user)
    {
        // hanya seller yang bisa dibuka profilnya
        if ($user->role !== 'seller') {
            abort(404);
        }

        // load ulasan yang diterima seller
        $user->load(['receivedReviews.buyer']);

        $avg = round($user->averageRating(), 1);
        $cnt = $user->ratingCount();

        return view('pages.seller_profile', compact('user', 'avg', 'cnt'));
    }
}
