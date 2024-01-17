<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        $cities = $this->city;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'isoCode' => $this->iso_code,
            'cities' => $cities,
        ];
    }
}
