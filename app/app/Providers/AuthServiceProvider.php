<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Используем Spatie Permission для проверки ролей
        Gate::define('admin', function (User $user) {
            return $user->hasRole('admin'); // Проверка роли через Spatie
        });

        Gate::define('user', function (User $user) {
            return $user->hasRole('user');
        });
    }
}
