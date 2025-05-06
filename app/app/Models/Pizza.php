<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pizza extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'type_id'
    ];

    public function getImageUrlAttribute($value)
    {
        return $value ? asset('storage/pizzas/' . $value) : asset('storage/pizzas/default.png');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }


}


