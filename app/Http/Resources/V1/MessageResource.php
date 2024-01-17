<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        $message = $this->message;
        $client = $this->starter;

        return [
            'id' => $this->id,
            'starterId' => $this->starter_id,
            'starterName' => $client->name,
            'ads_title' => $this->ads_title,
            'messages' => $message,
            'created' => $this->created_at,
            'updated' => $this->updated_at
        ];
    }
}
