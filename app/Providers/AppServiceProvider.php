<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
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
        Gate::define("courier", function (User $user) {
            if ($user->type !== "courier")
                return Response::denyWithStatus(403, "permission denied");
            return Response::allow();
        });
        Gate::define("trucker", function (User $user) {
            if ($user->type !== "trucker")
                return Response::denyWithStatus(403, "permission denied");
            return Response::allow();
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
