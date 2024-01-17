<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AdsPackageResource;
use App\Models\AdsPackage;
use Illuminate\Http\Request;

class AdsPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $whereCommercial = [
            'status' => 1, // check if package is active
        ];

        $packages = AdsPackage::where($whereCommercial)
            ->paginate();

        return AdsPackageResource::collection($packages);
    }
}
