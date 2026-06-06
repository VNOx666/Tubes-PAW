<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Buyer Test',
            'email' => 'buyer@test.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
        ]);

        User::create([
            'name' => 'Seller Test',
            'email' => 'seller@test.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
        ]);
    }
}
