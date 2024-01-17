<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsAttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        $category = $this->category;
        return [
            'id' => $this->id,
            'categoryId' => $this->category_id,
            'categoryName' => $category->title,
            'attributeType' => $this->attribute_type,
            'attributeName' => $this->attribute_name,
            'attributeValues' => $this->attribute_value,
        ];
    }
}
