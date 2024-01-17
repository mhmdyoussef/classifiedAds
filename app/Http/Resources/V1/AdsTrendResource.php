<?php

namespace App\Http\Resources\V1;

use App\Models\AdsTrend;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsTrendResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        $package = $this->package;
        $client = $this->client;

        $comment = AdsTrend::find($this->id)->comment()
            ->where([
                'ad_type' => 'trend',
                'is_approved' => true,
            ])
            ->get();

        $rateAverage = AdsTrend::find($this->id)->review()
            ->where([
                'type' => 'trend',
            ])
            ->avg('rate');

        $countRates = AdsTrend::find($this->id)->review()
            ->where([
                'type' => 'trend',
            ])
            ->count();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'label' => $this->label,
            'client_id' => $this->client_id,
            'clientName' => $client->name,
            'package_id' => $this->package_id,
            'packageName' => $package->title,
            'subscriptionId' => $this->subscription_id,
            'image' => $this->image,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'href' => $this->href,
            'views' => $this->views,
            'isActive' => $this->is_active,
            'isApproved' => $this->is_approved,
            'isPremiumExtra' => $this->is_premium_extra,
            'isFeatured' => $this->is_featured,
            'comments' => $comment,
            'votesRate' => $rateAverage,
            'votesCount' => $countRates,
            'status' => $this->status,
        ];
    }
}
