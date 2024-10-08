<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use App\Models\Container;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            ->whereHas("status", function ($query) {
                $query->where("status", "=", "Pending pickup");
            })
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

    public function carryPendingPickupPackages(Request $request) {
        $validator = Validator::make($request->all(), [
            "package_id_list" => "required|array"
        ]);
        if ($validator->fails())
            return response([
                "message" => "data can not be processed"
            ], 422);
        $packages = collect([]);
        foreach ($request->package_id_list as $id) {
            $package = $request
                ->user()
                ->pickupPackages()
                ->where("id", "=", $id)
                ->whereHas("status", function ($query) {
                    $query->where("status", "=", "Pending pickup");
                })
                ->first();
            if ($package === null)
                continue;
            $packages->push($package);
        }
        $pickedUpPackages = $request
            ->user()
            ->pickupPackages()
            ->whereHas("status", function ($query) {
                $query->where("status", "!=", "Pending pickup");
            })
            ->count();
        if ($packages->count() > 5 - $pickedUpPackages)
            return [
                "message" => "over the courier's remaining capacity",
                "data" => [
                    "remaining_capacity" => 5 - $pickedUpPackages
                ]
            ];
        foreach ($packages as $package)
            $package->progress()->insert([
                "status" => "Pending delivery",
                "package_id" => $package->id,
                "created_at" => now(),
                "updated_at" => now()
            ]);
        return [
            "message" => "success",
            "data" => [
                "package_id_list" => $packages->map(fn ($package) => $package->id)
            ]
        ];
    }

    public function getPickedUpPackages(Request $request) {
        $packages = $request
            ->user()
            ->pickupPackages()
            ->whereHas("status", function ($query) {
                $query->where("status", "=", "Picked up");
            })
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

    public function packPackages(Request $request) {
        $validator = Validator::make($request->all(), [
            "package_id_list" => "required|array"
        ]);
        if ($validator->fails())
            return response([
                "message" => "data can not be processed"
            ], 422);
        $packages = collect([]);
        foreach ($request->package_id_list as $id) {
            $package = $request
                ->user()
                ->pickupPackages()
                ->where("id", "=", $id)
                ->whereHas("status", function ($query) {
                    $query->where("status", "=", "Picked up");
                })
                ->first();
            if ($package === null)
                continue;
            $packages->push($package);
        }
        $pickedUpPackages = $request
            ->user()
            ->pickupPackages()
            ->whereHas("status", function ($query) {
                $query->where("status", "!=", "Picked up");
            })
            ->count();
        if ($packages->count() > 5 - $pickedUpPackages)
            return [
                "message" => "over the courier's remaining capacity",
                "data" => [
                    "remaining_capacity" => 5 - $pickedUpPackages
                ]
            ];
        foreach ($packages as $package) {
            $container = Container::query()
                ->where("from_campus_id", "=", $package->fromCampus->id)
                ->where("to_campus_id", "=", $package->toCampus->id)
                ->withCount("packages")
                ->where("packages_count", "<", 5)
                ->first();
            if ($container === null)
                $container = Container::create([
                    "from_campus_id" => $package->fromCampus->id,
                    "to_campus_id" => $package->toCampus->id,
                ]);

            $package->update([
                "container_id" => $container->id
            ]);
            $package->progress()->insert([
                "status" => "Pending transit",
                "package_id" => $package->id,
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }
        return [
            "message" => "success",
            "data" => [
                "package_id_list" => $packages->map(fn ($package) => $package->id)
            ]
        ];
    }

    public function getPendingDelivery(Request $request) {
        $packages = $request
            ->user()
            ->pickupPackages()
            ->whereHas("status", function ($query) {
                $query->where("status", "=", "Pending delivery");
            })
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

    public function carryPendingDeliveryPackages(Request $request) {
        $validator = Validator::make($request->all(), [
            "package_id_list" => "required|array"
        ]);
        if ($validator->fails())
            return response([
                "message" => "data can not be processed"
            ], 422);
        $packages = collect([]);
        foreach ($request->package_id_list as $id) {
            $package = $request
                ->user()
                ->pickupPackages()
                ->where("id", "=", $id)
                ->whereHas("status", function ($query) {
                    $query->where("status", "=", "Pending delivery");
                })
                ->first();
            if ($package === null)
                continue;
            $packages->push($package);
        }
        $pickedUpPackages = $request
            ->user()
            ->pickupPackages()
            ->whereHas("status", function ($query) {
                $query->where("status", "!=", "Pending delivery");
            })
            ->count();
        if ($packages->count() > 5 - $pickedUpPackages)
            return [
                "message" => "over the courier's remaining capacity",
                "data" => [
                    "remaining_capacity" => 5 - $pickedUpPackages
                ]
            ];
        foreach ($packages as $package)
            $package->progress()->insert([
                "status" => "Delivering",
                "package_id" => $package->id,
                "created_at" => now(),
                "updated_at" => now()
            ]);
        return [
            "message" => "success",
            "data" => [
                "package_id_list" => $packages->map(fn ($package) => $package->id)
            ]
        ];
    }

    public function getDelivering(Request $request) {
        $packages = $request
            ->user()
            ->pickupPackages()
            ->whereHas("status", function ($query) {
                $query->where("status", "=", "Delivering");
            })
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

    public function delivered(Request $request, string $package_id) {
        $package = Package::find($package_id);
        if (!$package)
            return response([
                "message" => "not found"
            ], 404);
        $package->progress()->insert([
            "status" => "Signed",
            "package_id" => $package->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        return [
            "message" => "success",
        ];
    }

    public function getDelivered(Request $request) {
        $packages = $request
            ->user()
            ->pickupPackages()
            ->whereHas("status", function ($query) {
                $query->where("status", "=", "Signed");
            })
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
