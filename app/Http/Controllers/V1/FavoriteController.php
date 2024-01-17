<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseTrait;
use App\Http\Requests\StoreAdsFavoriteRequest;
use App\Http\Requests\UpdateAdsFavoriteRequest;
use App\Http\Resources\V1\FavoriteResource;
use App\Models\AdsFavorite;
use GuzzleHttp\Psr7\Request;
use Illuminate\Validation\ValidationException;

class FavoriteController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth('sanctum')->user();

        // validation
        if (!$user) {
            throw ValidationException::withMessages([
                'favorite' => 'Login to list your favorite.'
            ]);
        }

        $favorites = AdsFavorite::where('client_id', $user->id)
            ->paginate();
        return FavoriteResource::collection($favorites);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdsFavoriteRequest $request)
    {

        $user = $request->user();

        // Validation
        if (!$user) {
            throw ValidationException::withMessages([
                'favorite' => 'Login to update your favorite list.'
            ]);
        }

        // collect client_id
        $request->merge(['client_id' => $user->id]);

        AdsFavorite::create($request->all());

        return $this->successResponse('This ads added to favorite list.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdsFavorite $favorite)
    {
        $favorite->delete();

        return $this->successResponse('Ads removed from list');
    }
}
