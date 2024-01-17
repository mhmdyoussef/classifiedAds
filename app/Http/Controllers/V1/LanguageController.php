<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseTrait;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use App\Http\Resources\V1\LanguageResource;



class LanguageController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LanguageResource::collection(Language::paginate());

    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        return new LanguageResource($language);
    }

}
