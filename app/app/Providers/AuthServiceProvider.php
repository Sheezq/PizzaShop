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
        $this->registerPolicies();


        Gate::define('admin', function (User $user) {
            return !$user->banned && $user->hasRole('admin');
        });


        Gate::define('user', function (User $user) {
            return !$user->banned && $user->hasRole('user');
        });


        Gate::before(function (User $user) {
            if ($user->banned) {
                return false;
            }
            return null;
        });
    }
}
