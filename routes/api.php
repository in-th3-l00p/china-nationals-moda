<?php

use App\Http\Controllers\Api\Client\AuthController;
use \App\Http\Controllers\Api\Staff\AuthController as StaffAuthController;
use App\Http\Controllers\Api\Client\ClientController;
use App\Http\Controllers\Api\Staff\CourierController;
use App\Http\Controllers\Api\Staff\StaffController;
use Illuminate\Support\Facades\Route;

Route::post("/v1/auth/signup", [AuthController::class, "signUp"]);
Route::post("/v1/auth/signin", [AuthController::class, "signIn"]);
Route::post("/v1/staff/signin", [StaffAuthController::class, "signIn"]);

Route::get(
    "/v1/track/{tracking_number}",
    [ClientController::class, "trackPackage"]
);

Route::middleware("auth:sanctum")->group(function () {
    Route::middleware("can:user")->group(function () {
        Route::post("/v1/auth/signout", [AuthController::class, "signOut"])
            ->middleware("auth:sanctum");
        Route::get(
            "/v1/campus",
            [ClientController::class, "getCampuses"]
        );
        Route::post(
            "/v1/package",
            [ClientController::class, "sendPackage"]
        );
        Route::get(
            "/v1/package",
            [ClientController::class, "getPackages"]
        );
        Route::patch(
            "/v1/package/{package_id}",
            [ClientController::class, "returnPackage"]
        );
    });

    Route::middleware("can:staff")->group(function () {
        Route::get("/v1/staff/information", [
            StaffController::class,
            "getInformation"
        ]);

        Route::middleware("can:courier")->group(function () {
            Route::post("/v1/courier/online-toggle", [
                CourierController::class,
                "onlineToggle"
            ]);

            Route::get("/v1/courier/package/pickup/pending", [
                CourierController::class,
                "getPendingPickup"
            ]);

            Route::post("/v1/courier/package/pickup/carry", [
                CourierController::class,
                "carryPendingPickupPackages"
            ]);

            Route::get("/v1/courier/package/delivery/pending", [
                CourierController::class,
                "getPendingDelivery"
            ]);

        });
    });
});

