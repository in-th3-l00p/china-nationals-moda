<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackPackageResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            "message" => "success",
            "data" => [
                "tracking_number" => $this->tracking_number,
                "from_campus" => "Campus " . $this->fromCampus->letter,
                "from_address" => $this->fromAddress,
                "to_campus" => "Campus " . $this->toCampus->letter,
                "to_address" => $this->toAddress,
                "status" => $this->status->status,
                "progress" => $this->progress()->get()->map(fn ($progress) => [
                    "status" => $progress->status,
                    "datetime" => $progress->created_at,
                    "campus" => $this->when(
                        $progress->status === "In transit",
                        "Campus " . $progress->campus->letter
                    )
                ])
            ]
        ];
    }
}
