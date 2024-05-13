<?php

namespace App\Providers;

use App\Gateway\InertiaDisableSSRGateway;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Inertia\Ssr\HttpGateway;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(HttpGateway::class, InertiaDisableSSRGateway::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    public function boot(): void
    {
        // ref https://laravel.com/docs/10.x/validation#defining-default-password-rules
        Password::defaults(function () {
            return Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });
    }
}
