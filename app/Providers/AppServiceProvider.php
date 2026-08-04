<?php

namespace App\Providers;

use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
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
        // Set sanctum PersonalAccessToken to have ulid IDs
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        // Set default password rules
        Password::defaults(function () {
            $rule = Password::min(8)
                ->max(128)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols();

            return $this->app->isProduction()
                ? $rule->uncompromised()
                : $rule;
        });

        // Set scalar route gate
        Gate::define('viewScalar', static function (Authentication $user) {
            return $user->email === 'admin@mrxuh.jo';
        });
    }
}
