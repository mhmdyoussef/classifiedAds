<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomPageResource;
use App\Models\CustomPage;
use Illuminate\Http\Request;

class CustomPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CustomPageResource::collection(CustomPage::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomPage $page)
    {
        return new CustomPageResource($page);
    }
}
