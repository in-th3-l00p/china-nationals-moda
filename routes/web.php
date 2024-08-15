<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\TruckerController;
use App\Models\Campus;
use Illuminate\Support\Facades\Route;

/* auth controller */
Route::get("/login", [AuthController::class, "loginForm"])->name("login.form");
Route::post("/login", [AuthController::class, "login"])->name("login.submit");
Route::get("/logout", [AuthController::class, "logout"])->name("logout");

Route::middleware("can:admin")->group(function () {
    Route::get("/dashboard", function () {
        return view("index", [
            "campuses" => Campus::query()
                ->with("fr_truckers")
                ->with("sr_truckers")
                ->orderBy("letter")
                ->get()
        ]);
    })->name("dashboard");

    Route::resource("campuses", CampusController::class);
    Route::resource("packages", PackageController::class);
    Route::resource("courier", CourierController::class);
    Route::resource("trucker", TruckerController::class);
});
