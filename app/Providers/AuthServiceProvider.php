<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('admin', function (User $user) {
            return $user->roles->slug === 'admin';
        });
        Gate::define('creator', function (User $user) {
            return $user->roles->slug === 'creator';
        });
        Gate::define('public', function (User $user) {
            return $user->roles->slug === 'public';
        });
    }
}
