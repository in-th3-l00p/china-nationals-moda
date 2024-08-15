<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

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
        Gate::define("admin", function (User $user) {
            return $user->type === "admin";
        });
        Gate::define("staff", function (User $user) {
            return $user->type === "trucker" || $user->type === "courier";
        });
        Gate::define("user", function (User $user) {
            return $user->type === "user";
        });
        Sanctum::getAccessTokenFromRequestUsing(
            function ($request) {
                return $request->token;
            }
        );
    }
}
