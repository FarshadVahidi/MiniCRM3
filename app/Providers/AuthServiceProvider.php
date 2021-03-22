<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('users-create', function (User $user) {
           return $user->hasPermission('users-create');
        });

        Gate::define('users-read', function (User $user) {
           return $user->hasPermission('users-read');
        });

        Gate::define('users-update', function (User $user) {
            return $user->hasPermission('users-update');
        });

        Gate::define('users-delete', function (User $user) {
            return $user->hasPermission('users-delete');
        });

        Gate::define('companies-create', function (User $user) {
            return $user->hasPermission('companies-create');
        });

        Gate::define('companies-read', function (User $user) {
            return $user->hasPermission('companies-read');
        });

        Gate::define('companies-update', function (User $user) {
            return $user->hasPermission('companies-update');
        });

        Gate::define('companies-delete', function (User $user) {
            return $user->hasPermission('companies-delete');
        });

        Gate::define('profile-create', function (User $user) {
            return $user->hasPermission('profile-create');
        });


        Gate::define('profile-read', function (User $user) {
            return $user->hasPermission('profile-read');
        });

        Gate::define('profile-update', function (User $user) {
            return $user->hasPermission('profile-update');
        });

        Gate::define('profile-delete', function (User $user) {
            return $user->hasPermission('profile-delete');
        });
    }
}
