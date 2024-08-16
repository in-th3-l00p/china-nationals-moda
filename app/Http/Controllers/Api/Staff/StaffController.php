<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use App\Models\Container;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function getInformation(Request $request) {
        if ($request->user()->type === "courier") {
            $pickupPackagesCount = User::query()
                ->where("id", "=", $request->user()->id)
                ->withCount("pickupPackages")
                ->first(["pickup_packages_count"])
                ->pickup_packages_count;
            $deliveredPackagesCount = User::query()
                ->where("id", "=", $request->user()->id)
                ->withCount("deliveryPackages")
                ->first(["delivery_packages_count"])
                ->delivery_packages_count;

            return response([
                "message" => "success",
                "data" => [
                    "id" => $request->user()->id,
                    "firstname" => $request->user()->first_name,
                    "lastname" => $request->user()->last_name,
                    "email" => $request->user()->email,
                    "phone_number" => $request->user()->number,
                    "affiliated_campus" => $request->user()->campus->letter,
                    "remaining_capacity" => 5 - $pickupPackagesCount,
                    "total_picked" => $pickupPackagesCount,
                    "total_delivered" => $deliveredPackagesCount,
                    "online" => $request->user()->online
                ]
            ]);
        }

        $pickupPackagesCount = $request->user()
            ->containers()
            ->withCount("packages")
            ->sum("packages_count");
        return response([
            "message" => "success",
            "data" => [
                "id" => $request->user()->id,
                "firstname" => $request->user()->first_name,
                "lastname" => $request->user()->last_name,
                "email" => $request->user()->email,
                "plate_number" => $request->user()->plate,
                "current_campus" => $request->user()->campus->letter,
                "remaining_capacity" => 15 - $pickupPackagesCount,
                "total_unloaded" => Container::onlyTrashed()
                    ->where("trucker_id", "=", $request->user()->id)
            ]
        ]);
    }
}
