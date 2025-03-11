<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    // Разрешенные для массового заполнения поля
    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
    ];

    // Аксессор для корректного отображения изображения
    public function getImageUrlAttribute($value)
    {
        return $value ? asset('storage/pizzas/' . $value) : asset('storage/pizzas/default.png');
    }
}
