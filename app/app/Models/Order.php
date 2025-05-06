<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'name',
        'email',
        'phone',
        'address',
        'note',
        'payment_method',
        'items',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'cart_data' => 'array',
        'items' => 'array',
    ];
}

