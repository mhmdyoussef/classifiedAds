<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AdsAttributeResource;
use App\Models\AdsAttribute;
use Illuminate\Database\Console\Migrations\ResetCommand;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdsAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // validate if category parameter sent
        if (! $request->category_id) {
            throw ValidationException::withMessages([
                'category' => 'Provide a category to get attributes.'
            ]);
        }

        $attributesWhere = [
//            'category_id' => $request->category_id,
            'status' => true,
        ];

        $attributes = AdsAttribute::where($attributesWhere)
            ->get();

        return AdsAttributeResource::collection($attributes);
    }
}
