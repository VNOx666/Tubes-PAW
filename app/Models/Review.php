<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Review extends Model
{
    protected $fillable = ['order_id','buyer_id','seller_id','rating','comment'];

    public function order(): BelongsTo { return $this->belongsTo(Order::class); }
    public function buyer()
{
    return $this->belongsTo(\App\Models\User::class, 'buyer_id');
}
    public function seller(): BelongsTo { return $this->belongsTo(User::class, 'seller_id'); }

}
