<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdsTrendRequest;
use App\Http\Requests\UpdateAdsTrendRequest;
use App\Http\Resources\V1\AdsTrendResource;
use App\Models\AdsTrend;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdsTrendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commercialTypes = [
            'is_active' => 1, // check if ads is active
            'is_approved' => 1, // check if approved by administration
        ];

        // package data
        $commercialAds = AdsTrend::with(['package'])
            ->where($commercialTypes)
            ->orderBy('is_premium_extra', 'desc')
            ->orderBy('is_featured', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate();

        return AdsTrendResource::collection($commercialAds);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdsTrendRequest $request)
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

        // store trend
        $trend = AdsTrend::create($request->all());

        return new AdsTrendResource($trend);
    }

    /**
     * Display the specified resource.
     */
    public function show(AdsTrend $trend)
    {
        if (!$trend->is_approved) {
            throw new NotFoundHttpException('Trend not found');
        }

        // increase views count
        $trend->increment('views');

        // save last seen
        $user = auth('sanctum')->user();

        AdsLastseenController::storeCurrentOnLastSeen(AdsTrend::class, $trend->id, $user->id);

        return new AdsTrendResource($trend);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdsTrendRequest $request, AdsTrend $trend)
    {

        // TODO: if is dirty start_date redirect to payment gateway
        if ($request->start_date != $trend->start_date) {
            //
        }

        $trend->update($request->all());
        return new AdsTrendResource($trend);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdsTrend $trend)
    {
        if (!$trend) {
            throw new NotFoundHttpException('Trend not found');
        }

        if ($trend->image) {
            foreach ($trend->image as $item) {
                Storage::delete($item);
            }
        }

        $trend->delete();

        return response()->json([
            "status" => 'Success',
            "message" => 'Your commercial advertisement permanently deleted.',
        ]);
    }
}
