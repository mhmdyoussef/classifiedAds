<?php

namespace App\Http\Resources\V1;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        $country = $this->country;
        $zones = $this->zone;

        return [
            'id' => $this->id,
            'cityName' => $this->title,
            'country' => $country->name,
            'zones' => $zones,
        ];
    }
}
