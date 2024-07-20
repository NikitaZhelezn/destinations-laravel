<?php

namespace App\Http\Resources\Api\Destinations;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * class DestinationResource;
 *
 * Resource to parse DB data for response.
 */
class DestinationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'lat' => $this->lat,
            'lon' => $this->lon,
            'distance' => $this->distance,
        ];
    }
}
