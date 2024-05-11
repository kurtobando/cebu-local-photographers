<?php

namespace App\Providers;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        // ref https://spatie.be/docs/laravel-permission/v5/basic-usage/super-admin
        Gate::before(function ($user) {
            return $user->hasRole(UserRoleEnum::SUPER_ADMIN->value) ? true : null;
        });
    }
}
