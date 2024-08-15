<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signUp(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => "required|email:strict|unique:users,email",
            "password" => "required|min:4",
            "repeat_password" => "required|min:4",
            "phone_number" => "required|min:8|max:12",
            "firstname" => "required",
            "lastname" => "required",
        ]);
        if ($validator->fails()) {
            if (Validator::make($request->all(), [
                "email" => "unique:users,email"
            ])->fails())
                return response([
                    "message" => "email has already been used"
                ], 409);
            return response([
                "message" => "data can not be processed"
            ], 422);
        }
        $data = $validator->getData();
        if ($data["password"] !== $data["repeat_password"])
            return response([
                "message" => "repeat_password is not same with password field"
            ], 422);
        $user = User::create([
            "email" => $data["email"],
            "password" => Hash::make($data["password"]),
            "phone" => $data["phone_number"],
            "first_name" => $data["firstname"],
            "last_name" => $data["lastname"],
            "type" => "user"
        ]);
        return response([
            "message" => "success",
            "data" => [
                "id" => $user->id,
                "email" => $user->email,
                "phone_number" => $user->phone,
                "firstname" => $user->first_name,
                "lastname" => $user->last_name,
                "token" => $user
                    ->createToken("auth", ["type:user"])
                    ->plainTextToken
            ]
        ]);
    }

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
            ->user()
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
                    ->plainTextToken
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
