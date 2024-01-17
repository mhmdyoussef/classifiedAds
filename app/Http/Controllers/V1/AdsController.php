<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseTrait;
use App\Http\Requests\StoreAdsRequest;
use App\Http\Requests\UpdateAdsRequest;
use App\Http\Resources\V1\AdsResource;
use App\Models\Ads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AdsController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commercialTypes = [
            'is_active' => 1, // check if ads is active
            'is_approved' => 1, // check if approved by administration
            'status' => 1,
        ];

        // package data
        $ads = Ads::where($commercialTypes)
            ->orderBy('is_premium_extra', 'desc')
            ->orderBy('is_featured', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate();

        return AdsResource::collection($ads);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdsRequest $request)
    {
        // collect user id
        $user = auth('sanctum')->user();
        $request->merge(['client_id' => $user->id]);

        // store images
        foreach($request->images as $image) {
            $image = $image->store('public/' . date('Ymd'));
            $paths[] = str_replace('public/', '', $image);
        }

        $request->merge(['image' => $paths]);

        $ads = Ads::create($request->all());

        return new AdsResource($ads);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ads $ad)
    {
        // increase views count
        $ad->increment('views');

        // save last seen
        $user = auth('sanctum')->user();

        AdsLastseenController::storeCurrentOnLastSeen(Ads::class, $ad->id, $user->id);

        return new AdsResource($ad);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdsRequest $request, Ads $ad)
    {
        $ad->update($request->all());
        return new AdsResource($ad);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ads $ad)
    {
        $ad->delete();
        return $this->successResponse('Your ad has been deleted.');
    }
}
