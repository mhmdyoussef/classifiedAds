<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseTrait;
use App\Http\Requests\StoreAdsCommentRequest;
use App\Models\AdsComment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdsCommentController extends Controller
{
    use ResponseTrait;
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdsCommentRequest $request)
    {
        if (!auth('sanctum')->user()) {
            throw ValidationException::withMessages([
                'user' => 'only user can comment.'
            ]);
        }

        // collect client id
        $user = auth('sanctum')->user();
        $request->merge(['client_id' => $user->id]);
//return $request;
        $comment = AdsComment::updateOrCreate($request->all());

        return $this->successResponse('Your comment has been sent');
    }
}
