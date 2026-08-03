<?php

namespace App\Providers;

use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Models\PersonalAccessToken;
use Modules\Authentication\Models\Authentication;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        Gate::define('viewScalar', static function (Authentication $user) {
            return $user->email === 'admin@mrxuh.jo';
        });
    }
}
