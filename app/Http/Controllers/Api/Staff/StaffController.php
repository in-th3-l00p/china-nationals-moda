<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function getInformation(Request $request) {
        $pickupPackagesCount = User::query()
            ->where("id", "=", $request->user()->id)
            ->withCount("pickupPackages")
            ->get(["pickup_packages_count"])
            ->pickup_packages_count;
        $deliveredPackagesCount = User::query()
            ->where("id", "=", $request->user()->id)
            ->withCount("deliveryPackages")
            ->get(["delivery_packages_count"])
            ->delivery_packages_count;
        if ($request->user()->type === "courier")
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
        return response([
            "message" => "success",
            "data" => [
                "id" => $request->user()->id,
                "firstname" => $request->user()->first_name,
                "lastname" => $request->user()->last_name,
                "email" => $request->user()->email,
                "plate_number" => $request->user()->plate,
                "current_campus" => $request->user()->campus->letter,
            ]
        ]);
    }
}
