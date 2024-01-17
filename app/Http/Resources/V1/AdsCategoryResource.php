<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'parentCategory' => $this->parent_id,
            'title' => $this->title,
            'description' => $this->description,
            'label' => $this->label,
            'image' => $this->image,
            'icon' => $this->icon,
            'sortOrder' => $this->sort_order,
            'isFeatured' => $this->is_featured,
            'status' => $this->status,
        ];
    }
}
