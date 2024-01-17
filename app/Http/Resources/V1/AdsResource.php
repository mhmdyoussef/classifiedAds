<?php

namespace App\Http\Resources\V1;

use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        $client = $this->client;
        $category = $this->category;
        $package = $this->package;

        $comment = Ads::find($this->id)->comment()
            ->where([
                'ad_type' => 'trend',
                'client_id' => $this->client_id,
            ])
            ->get();

        $rateAverage = Ads::find($this->id)->review()
            ->where([
                'type' => 'trend',
            ])
            ->avg('rate');

        $countRates = Ads::find($this->id)->review()
            ->where([
                'type' => 'trend',
            ])
            ->count();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'label' => $this->label,
            'clientId' => $this->client_id,
            'clientName' => $client->name,
            'categoryId' => $this->category_id,
            'categoryName' => $category->title,
            'packageId' => $this->package_id,
            'packageName' => $package->title,
            'subscriptionId' => $this->subscription_id,
            'attributes' => $this->attributes,
            'image' => $this->image,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'price' => $this->price,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'startDate' => $this->start_date,
            'sortOrder' => $this->sort_order,
            'views' => $this->views,
            'isFeatured' => $this->is_featured,
            'isActive' => $this->is_active,
            'isPremiumExtra' => $this->is_premium_extra,
            'isApproved' => $this->is_approved,
            'comments' => $comment,
            'votesRate' => $rateAverage,
            'votesCount' => $countRates,
            'status' => $this->status,
        ];
    }
}
