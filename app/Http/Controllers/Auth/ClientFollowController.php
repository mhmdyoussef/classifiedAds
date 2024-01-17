<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseTrait;
use App\Models\ClientFollow;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClientFollowController extends Controller
{
    use ResponseTrait;

    public function store(Request $request)
    {
        if (!auth('sanctum')->user()) {
            throw ValidationException::withMessages([
                'user' => 'only user can follow users.'
            ]);
        }

        // collect client id
        $user = auth('sanctum')->user();
        $request->merge(['follower_id' => $user->id]);

        ClientFollow::updateOrCreate($request->all());

        return $this->successResponse('Your follow has been sent');
    }
}
