<?php

namespace App\Http\Resources\V1;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DescriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $language = $this->language;

        return [
            'id' => $this->id,
            'languageName' => $language->code,
            'title' => $this->title,
            'description' => $this->description,
            'label' => $this->label,
        ];

    }
}
