<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'banned',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'banned' => 'boolean',
    ];

    protected $appends = ['is_banned'];

    public function getIsBannedAttribute(): bool
    {
        return (bool) $this->attributes['banned'];
    }

    public function getIsAdminAttribute(): bool
    {
        return $this->hasRole('admin');
    }

    // Переопределение getAuthIdentifierName() для использования кастомного поля
    public function getAuthIdentifierName(): string
    {
        return 'email';  // или 'id' если ты используешь id
    }
}
