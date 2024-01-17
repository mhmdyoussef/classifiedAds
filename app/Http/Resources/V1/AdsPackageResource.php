<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsPackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'label' => $this->label,
            'duration' => $this->duration,
            'price' => number_format($this->price, 3),
            'isFeatured' => $this->is_featured,
            'isPremiumPackage' => $this->is_premium_package,
            'sortOrder' => $this->sort_order,
            'status' => $this->status,
        ];
    }
}
