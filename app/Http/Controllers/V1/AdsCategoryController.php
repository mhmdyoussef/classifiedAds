<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AdsCategoryResource;
use App\Models\AdsCategory;
use Illuminate\Http\Request;

class AdsCategoryController extends Controller
{
    /**
     * Display a listing of Ads Categories.
     */
    public function index(Request $request)
    {
        if ($request->header('accept-language')) {
            //
        }
        $whereCommercial = [
            'status' => 1, // check if Category is active
        ];

        $categories = AdsCategory::where($whereCommercial)
            ->paginate();

        return AdsCategoryResource::collection($categories);
    }
}
