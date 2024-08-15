<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm() {
        return view("login");
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            "username" => "required|min:4|max:20",
            "password" => "required|min:4|max:20"
        ]);

        if (!Auth::attempt([
            ...$credentials,
            "type" => "admin"
        ])) {
            return back()
                ->withErrors([
                    "auth" => "Incorrect username or password."
                ]);
        }

        return redirect()->route("dashboard");
    }

    public function logout() {
        Auth::logout();
        return redirect()->route("login.form");
    }
}
