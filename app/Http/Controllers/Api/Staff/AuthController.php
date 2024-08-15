<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signIn(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => "required|email:strict",
            "password" => "required|min:4"
        ]);
        if ($validator->fails())
            return response([
                "message" => "data can not be processed"
            ], 422);
        $user = User::query()
            ->staff()
            ->where("email", "=", $validator->getData()["email"])
            ->first();
        if (
            $user === null ||
            !Hash::check(
                $validator->getData()["password"],
                $user->password
            )
        )
            return response([
                "message" => "client credentials are invalid"
            ], 401);

        return response([
            "message" => "success",
            "data" => [
                "id" => $user->id,
                "email" => $user->email,
                "firstname" => $user->first_name,
                "lastname" => $user->last_name,
                "token" => $user
                    ->createToken("auth", ["type:user"])
                    ->plainTextToken,
                "role" => $user->type
            ]
        ]);
    }

    public function signOut(Request $request) {
        $request
            ->user()
            ->currentAccessToken()
            ->delete();
    }
}
