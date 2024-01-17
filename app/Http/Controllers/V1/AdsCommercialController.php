<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdsCommercialRequest;
use App\Http\Requests\UpdateAdsCommercialRequest;
use App\Http\Resources\V1\AdsCommercialResource;
use App\Models\AdsCommercial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdsCommercialController extends Controller
{
    /**
     * Display a listing of the commercial.
     */
    public function index(Request $request)
    {
        $commercialTypes = [
            'is_active' => 1, // check if ads is active
            'is_approved' => 1, // check if approved by administration
        ];

        // package data
        $commercialAds = AdsCommercial::where($commercialTypes)
            ->orderBy('is_premium_extra', 'desc')
            ->orderBy('is_featured', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate();

        return AdsCommercialResource::collection($commercialAds);
    }

    /**
     * Store a newly created commercial in storage.
     */
    public function store(StoreAdsCommercialRequest $request)
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

        // store the commercial details
        $newAd = AdsCommercial::create($request->all());

        return new AdsCommercialResource($newAd);
    }

    /**
     * Display the specified commercial.
     */
    public function show(AdsCommercial $commercial)
    {
        // validate commercial ads
        if (!$commercial->is_approved && !$commercial->status && !$commercial->is_active) {
            throw new NotFoundHttpException('Commercial not found');
        }

        // increase views count
        $commercial->increment('views');

        // save last seen
        $user = auth('sanctum')->user();

        AdsLastseenController::storeCurrentOnLastSeen(AdsCommercial::class, $commercial->id, $user->id);

        return new AdsCommercialResource($commercial);
    }

    /**
     * Update the specified commercial in storage.
     */
    public function update(UpdateAdsCommercialRequest $request, AdsCommercial $commercial)
    {
        $commercial->update($request->all());
        return new AdsCommercialResource($commercial);
    }

    /**
     * Remove the specified resource from commercial.
     */
    public function destroy(AdsCommercial $commercial)
    {
        $commercial->delete();

        return response()->json([
            "status" => 'Success',
            "message" => 'Your commercial advertisement permanently deleted.',
        ]);
    }
}
