<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContainerResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "from_campus" => "Campus " . $this->fromCampus->letter,
            "to_campus" => "Campus " . $this->toCampus->letter,
            "packages" => $this->packages()->count(),
        ];
    }
}
