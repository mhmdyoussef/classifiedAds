<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseTrait;
use App\Http\Requests\Auth\VerifyPhoneRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VerifyPhoneController extends Controller
{
    use ResponseTrait;

    public function validateCode(VerifyPhoneRequest $request)
    {

        $client = Client::where('phone', $request->phone)->first();

        if (!$client) {
            throw ValidationException::withMessages([
                'phone' => 'The provided credentials are invalid.',
            ]);
        }

        if ($client->phone_code_verify != $request->verification_code) {
            throw ValidationException::withMessages([
                'verificationCode' => 'The code is not valid.',
            ]);
        }

        $client->phone_code_verify = null;
        $client->save();

        $token = $client->createToken('token-' . $request->phone, ['ads:view'])->plainTextToken;

        return $this->successResponse('Your account has been activated.', 201, $token, ['data' => $client,]);
    }

    public function resendValidateCode(Request $request)
    {

        $validate = $request->validate([
            'phone' => 'required|string|min:8|max:12',
        ]);

        $client = Client::where('phone', $request->phone)->first();

        if (!$client) {
            throw ValidationException::withMessages([
                'phone' => 'The number is not registered. Would like to create new account.',
            ]);
        }

        if ($client && is_null($client->phone_code_verify)) {
            throw ValidationException::withMessages([
                'phone' => 'Your account is already activated.',
            ]);
        }

        // TODO: send verification code saved on database

        $phone_code = $client->phone_code_verify;

        return response([
            "status" => true,
            "message" => 'Your verification code sent successfully.',
        ], 200);

    }
}
