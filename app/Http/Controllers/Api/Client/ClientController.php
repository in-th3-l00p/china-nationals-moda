<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\TrackPackageResource;
use App\Models\Campus;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller {
    public function trackPackage(string $tracking_number) {
        $package = Package::query()
            ->where("tracking_number", "=", $tracking_number)
            ->first();
        if (!$package)
            return response([
                "message" => "not found"
            ], 404);
        return new TrackPackageResource($package);
    }

    public function getCampuses() {
        return [
            "message" => "success",
            "data" => [
                Campus::query()
                    ->orderBy("letter")
                    ->get()
                    ->map(fn ($campus) => [
                        "id" => $campus->id,
                        "name" => "Campus " . $campus->letter
                    ])
            ]
        ];
    }

    public function sendPackage(Request $request) {
        $validator = Validator::make($request->all(), [
            "from_campus_id" => "required|integer",
            "from_address" => "required|string",
            "to_campus_id" => "required|integer",
            "to_address" => "required|string",
            "recipient_name" => "required",
            "recipient_phone_number" =>  "required|min:8|max:12"
        ]);
        if ($request->from_campus_id === $request->to_campus_id)
            return response([
                "message" => "cannot send the package to the same campus"
            ], 422);
        if (
            Campus::query()
                ->where("id", "=", $request->from_campus_id)
                ->count() === 0
            || Campus::query()
                ->where("id", "=", $request->to_campus_id)
                ->count() === 0
        )
            return response([
                "message" => "campus does not exist"
            ], 422);
        if ($validator->fails())
            return response([
                "message" => "data can not be processed"
            ], 422);
        $pickupCouriers = User::query()
            ->courier($request->from_campus_id)
            ->inRandomOrder()
            ->get();
        if ($pickupCouriers->count() === 0)
            return response([
                "message" => "no available couriers in the campus"
            ], 409);

        $package = Package::factory()
                ->withTrackingNumber(
                    Campus::find($request->from_campus_id),
                    Campus::find($request->to_campus_id)
                )->create([
                    "user_id" => $request->user()->id,
                    "from_address" => $request->from_address,
                    "to_address" => $request->to_address,
                    "recipient_name" => $request->recipient_name,
                    "recipient_phone_number" => $request->recipient_phone_number,
                    "pickup_courier_id" => $pickupCouriers[0]->id
                ]);
        $package->progress()->insert([
            "status" => "Pending pickup",
            "package_id" => $package->id,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        return response([
            "message" => "success",
            "data" => [
                "package_id" => $package->id,
                "courier_name" => $package->pickupCourier->first_name . " " . $package->pickupCourier->last_name,
                "courier_phone_number" => $package->pickupCourier->phone
            ]
        ], 201);
    }

    public function getPackages(Request $request) {
        return response([
            "message" => "success",
            "data" => $request
                ->user()
                ->sentPackages()
                ->get()
                ->map(fn ($package) => [
                    "id" => $package->id,
                    "tracking_number" => $package->tracking_number,
                    "from_campus" => "Campus " . $package->fromCampus->letter,
                    "from_address" => $package->from_address,
                    "to_campus" => "Campus " . $package->toCampus->letter,
                    "to_address" => $package->to_address,
                    "status" => $package->status->status,
                    "returning" => $package->status->returning,
                    "send_time" => $package->created_at,
                    "recipient" => [
                        "name" => $package->recipient_name,
                        "phone_number" => $package->recipient_phone_number
                    ]
                ])
        ]);
    }

    public function returnPackage(Request $request, string $package_id) {
        $package = Package::find($package_id);
        if (!$package)
            return response([
                "message" => "not found"
            ], 404);
        if ($package->user->id !== $request->user()->id)
            return response([
                "message" => "you cannot return other client's packages"
            ], 403);

        if ($package->status->returning === 0) {
            if ($package->status->status === "Pending pickup") {
                $package->progress()->insert([
                    "status" => "Signed",
                    "returning" => 1,
                    "package_id" => $package->id,
                    "created_at" => now(),
                    "updated_at" => now(),
                ]);
            } else if ($package->status->status === "Picked up") {
                $package->progress()->insert([
                    "status" => "Delivering",
                    "returning" => 1,
                    "package_id" => $package->id,
                    "created_at" => now(),
                    "updated_at" => now(),
                ]);
            } else if ($package->status->status === "Pending delivery") {
                $package->progress()->insert([
                    "status" => "Pending transit",
                    "returning" => 1,
                    "package_id" => $package->id,
                    "created_at" => now(),
                    "updated_at" => now(),
                ]);
            } else if ($package->status->status === "Delivering") {
                $package->progress()->insert([
                    "status" => "Picked up",
                    "returning" => 1,
                    "package_id" => $package->id,
                    "created_at" => now(),
                    "updated_at" => now(),
                ]);
            }
        }

        $package = Package::find($package_id);
        return response([
            "message" => "success",
            "data" => [
                "id" => $package->id,
                "status" => $package->status->status
            ]
        ]);
    }
}
