<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseTrait;
use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    use ResponseTrait;

    public function store(StoreReviewRequest $request)
    {
        if (!auth('sanctum')->user()) {
            throw ValidationException::withMessages([
                'user' => 'only user can comment.'
            ]);
        }

        // collect client id
        $user = auth('sanctum')->user();
        $request->merge(['client_id' => $user->id]);

        $rate = Review::create($request->all());

        return $this->successResponse('Your review has been sent');
    }
}
