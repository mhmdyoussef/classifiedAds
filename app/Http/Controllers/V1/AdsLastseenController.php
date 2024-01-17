<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AdsLastseenResource;
use App\Models\AdsCommercial;
use App\Models\AdsLastseen;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdsLastseenController extends Controller
{
    /**
     * List user last seen products
     */
    public function index()
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            throw ValidationException::withMessages([
                'user' => 'Login to check your last seen ads.'
            ]);
        }

        $latest = AdsLastseen::where('client_id', $user->id)->get();

        $products =  $this->getLatestads($latest);

        return AdsLastseenResource::collection($products);
    }

    /**
     * @param $className
     * @param $adsId
     * @param $clientId
     * @return void
     * Store ads to last seen table.
     */
    public static function storeCurrentOnLastSeen($className, $adsId, $clientId)
    {
        $lastSeenData = [
            'client_id' => $clientId,
            'ads_id' => $adsId,
            'ad_type' => $className,
        ];

        $counter = AdsLastseen::where('client_id', $clientId)->count();

        if ($counter == config('dealz.app_default_lastSeen')) {
            AdsLastseen::where('client_id', $clientId)->first()->delete();
        }

        AdsLastseen::updateOrCreate($lastSeenData);

    }

    /**
     * @param $lastSeenList
     * @return array
     * Get product list of the last seen.
     */
    protected function getLatestads($lastSeenList): array
    {
        // condition to show ads based on.
        $where = [
            'status' => true,
            'is_approved' => true,
        ];

        $ads = [];

        foreach ($lastSeenList as $item) {
            // collect ads id & ads type
            $model = $item['ad_type'];
            $ads_id = $item['ads_id'];

            // create instance of the ads type
            $modelInstance = app($model);

            // collect ads details
            $ads[] = $modelInstance->where('id', $ads_id)
                ->where($where)
                ->select(['id', 'title', 'image'])
                ->first();
        }

        return $ads;
    }
}
