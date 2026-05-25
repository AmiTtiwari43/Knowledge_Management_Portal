<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /** @use HasFactory<\Database\Factories\CouponFactory> */
    use HasFactory;

    protected $fillable = ['code', 'type', 'value', 'max_uses', 'used_count', 'expires_at'];

    protected function casts(): array
    {
        return ['expires_at' => 'datetime'];
    }

}
