<?php

namespace App\Http\Resources\V1;

use App\Models\AdsCategory;
use App\Models\AdsCategoryDescription;
use App\Models\AdsCommercial;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsCommercialResource extends JsonResource
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
        $category = $this->category;
        $client = $this->client;
        $comment = AdsCommercial::find($this->id)->comment()
            ->where([
                'ad_type' => 'trend',
                'client_id' => $this->client_id,
            ])
            ->get();

        $rateAverage = AdsCommercial::find($this->id)->review()
            ->where([
                'type' => 'trend',
            ])
            ->avg('rate');

        $countRates = AdsCommercial::find($this->id)->review()
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
            'category' => $category->title,
            'image' => $this->image,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'href' => $this->href,
            'price' => $this->price,
            'package' => $package->title,
            'subscriptionId' => $this->subscription_id,
            'startDate' => $this->start_date,
            'views' => $this->views,
            'sortOrder' => $this->sort_order,
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
