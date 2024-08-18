<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContainerResource;
use App\Models\Container;
use Illuminate\Http\Request;

class TruckerController extends Controller {
    public function getContainers(Request $request) {
        $containers = Container::query()
            ->where("trucker_id", "=", $request->user()->id)
            ->get();
        return [
            "message" => "success",
            "data" => ContainerResource::collection($containers)
        ];
    }

    public function getCurrentCampusContainers(Request $request) {
        $containers = Container::query()
            ->where("from_campus_id", "=", $request->user()->campus->id)
            ->whereNull("trucker_id")
            ->get();
        return [
            "message" => "success",
            "data" => ContainerResource::collection($containers)
        ];
    }

    public function loadContainer(Request $request, string $container_id) {
        $container = Container::find($container_id);
        if (
            !$container ||
            $container->trucker_id ||
            $container->fromCampus->id !== $request->user()->campus->id
        )
            return response([
                "message" => "not found"
            ], 404);
        $packagesCount = $request
                ->user()
                ->containers()
                ->withCount("packages")
                ->sum("packages_count");
        if ($packagesCount >= 15)
            return response([
                "message" => "over the trucker's remaining capacity",
                "data" => [
                    "remaining_capacity" => 15 - $packagesCount
                ]
            ], 409);

        $container->update([
            "trucker_id" => $request->user()->id
        ]);
        return response([
            "message" => "success"
        ]);
    }
}
