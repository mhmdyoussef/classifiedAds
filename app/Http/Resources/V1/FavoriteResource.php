<?php

namespace App\Http\Resources\V1;

use App\Models\Ads;
use App\Models\AdsCommercial;
use App\Models\AdsStore;
use App\Models\AdsTrend;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);

        $data = [];

        match ($this->ad_type) {
            'commercial' => $data[] = AdsCommercial::where([
                'id' => $this->ads_id
            ])
                ->first()
            ,
            'trend' => $data[] = AdsTrend::where([
                'id' => $this->ads_id,
                'is_approved' => true,
            ])
                ->select('id', 'title', 'label', 'image')
                ->first()
            ,
            'store' => $data[] = AdsStore::where([
                'id' => $this->ads_id
            ])
                ->first()
            ,
            default => $data[] = Ads::where([
                'id' => $this->ads_id
            ])
                ->first()
            ,
        };

        return array_filter($data, function ($value) {
            return !(is_null($value) || empty($value));
        });

    }


}
