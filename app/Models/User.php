<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'gender',
        'bio',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function isSeller(): bool
    {
        return $this->role === 'seller';
    }

    public function isBuyer(): bool
    {
        return $this->role === 'buyer';
    }

    public function receivedReviews(): HasMany
    {
        return $this->hasMany(Review::class, 'seller_id');
    }

    /**
     * Rata-rata rating seller (contoh sederhana).
     * Kalau kamu punya kolom rating di tabel reviews, ganti jadi avg('rating').
     */
    public function averageRating(): float
    {
        // Kalau tabel reviews punya kolom "rating":
        // return (float) ($this->receivedReviews()->avg('rating') ?? 0);

        // Kalau belum ada kolom rating, fallback:
        return 0.0;
    }

    public function ratingCount(): int
    {
        return (int) $this->receivedReviews()->count();
    }
}