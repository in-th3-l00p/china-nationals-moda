<?php

namespace Database\Factories;

use App\Models\Campus;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory {
    public function definition(): array {
        return [
        ];
    }

    public function withTrackingNumber(
        Campus $from,
        Campus $to
    ) {
        return $this->state(function (array $attributes) use ($from, $to) {
            $id = Package::query()->count() + 1;
            return [
                "id" => $id,
                "tracking_number" =>
                    "CE" .
                    $from->letter .
                    $to->letter .
                    Carbon::now()->format("Ymd") .
                    Str::padLeft($id, 3, "0"),
                "from_campus_id" => $from->id,
                "to_campus_id" => $to->id,
            ];
        });
    }
}
