<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseTrait;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\V1\ClientProfileResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClientProfileController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function profile(Request $request)
    {
        if (! $request->bearerToken()) {
            throw ValidationException::withMessages([
                'phone' => 'Please ensure you have the necessary permissions to perform this action.',
            ]);
        }

        // Client details
        $user = $request->user();

        // Client address
        $address = Client::find($user->id)->addresses;

        // following system
        $follows = Client::find($user->id)->follows()->count();
        $following = Client::find($user->id)->follows()
            ->where('following_id', $user->id)
            ->count();


        // Data to show on client profile
        $data = [
            'personalData' => $request->user(),
            'addresses' => $address,
            'followers' => [
                'following' => $follows,
                'followers' => $following,
            ],
        ];

        return new ClientProfileResource($data);
    }

    public function storeDefaultLanguage(StoreLanguageRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = $request->user();

        if (!$user->id) {
            throw ValidationException::withMessages([
                'user' => 'please sign in to set language',
            ]);
        }

        $user->language = $request->language_id;
        $user->save();

        return $this->successResponse('Language set successfully.', 201);
    }

}
