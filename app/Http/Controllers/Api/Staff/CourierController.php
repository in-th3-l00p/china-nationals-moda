<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourierController extends Controller {
    public function onlineToggle(Request $request) {
        $request->user()->update([
            "online" => !$request->user()->online
        ]);

        return response([
            "message" => "success",
            "data" => [
                "id" => $request->user()->id,
                "online" => $request->user()->online ? 1 : 0
            ]
        ]);
    }

    public function getPendingPickup(Request $request) {
        $packages = $request
            ->user()
            ->pickupPackages()
            ->with(["status" => function ($query) {
                $query->where("status", "=", "Pending delivery");
            }])
            ->get();
        return [
            "message" => "success",
            "data" => $packages->map(fn ($package) => [
                "id" => $package->id,
                "tracking_number" => $package->tracking_number,
                "from_campus" => "Campus " . $package->fromCampus->letter,
                "from_address" => $package->from_address,
                "to_campus" => "Campus " . $package->toCampus->letter,
                "to_address" => $package->to_address,
                "sender" => [
                    "id" => $package->user->id,
                    "firstname" => $package->user->first_name,
                    "lastname" => $package->user->last_name,
                    "phone_number" => $package->user->phone,
                ],
                "recipient" => [
                    "name" => $package->recipient_name,
                    "phone_number" => $package->recipient_phone_number,
                ]
            ])
        ];
    }
}
