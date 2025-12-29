<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'price',
        'description',
        'category',
        'grade',
        'size',
        'color',
        'quantity',
        'status',
        'image',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function seller()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

}
