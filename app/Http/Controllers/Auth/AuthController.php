<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseTrait;
use App\Http\Helper\Sms\SMSTreat;
use App\Http\Requests\Auth\StoreClientRequest;
use App\Http\Requests\Auth\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use SMSTreat, ResponseTrait;
    /**
     * Register new client.
     */
    public function register(StoreClientRequest $request)
    {
        // Checking if registered
        $user = Client::where('phone', $request->phone)->first();

        if ($user) {
            throw ValidationException::withMessages([
                'phone' => 'The provided credentials are already registered.',
            ]);
        }

        // Hashing password
        $request['password'] = Hash::make($request->password);

        // TODO: Generate verification code and send the current code on a sms to activate the account

        // Save client details to database
        $user = Client::create($request->only('name', 'phone', 'password'));

        // Generating code to verify phone number
        $user->phone_code_verify = $this->generateVerificationCode();
        $user->save();

        return $this->successResponse('Your account has been created. Please use code sent to your mobile to activate your account.', 201);
    }

    /**
     * Update client account.
     */
    public function update(UpdateClientRequest $request)
    {
        $user = $request->user;

        $data_to_update = $request->only(['name', 'email', 'language', 'phone', 'about', 'date_of_birth']);
return $request->all();
        if ($request->password) {
            $data_to_update['password'] = Hash::make($request->password);
        }

        if ($request->phone) {
            $data_to_update['phone_code_verify'] = $this->generateVerificationCode();
        }

        Client::where('id', $request->user()->id)
            ->update($data_to_update);

        if ($request->phone) {

            $this->purgeToken($request);

            // TODO: send sms with code generated

            return $this->successResponse('Your phone successfully updated, Please login again..');
        }

        return $this->successResponse('The provided credentials successfully updated.');

    }

    /**
     * Login exists Client.
     */
    public function login(Request $request)
    {

        $user = Client::where('phone', $request->phone)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'phone' => 'The provided credentials are incorrect.',
            ]);
        }

        if (! empty($user->phone_code_verify)) {
            // TODO send the current code on a sms to activate the account

            throw ValidationException::withMessages([
                'phone' => 'Activate account with OTP code.',
            ]);
        }

        $token = $user->createToken('token-' . $request->phone, ['ads:view'])->plainTextToken;

        return $this->successResponse(message: 'Welcome back ' . $user->name . ' ...',code: 200, token: $token, customData: ['user' => $user]);
    }

    /**
     * Logout client with token.
     */
    public function logout(Request $request)
    {
        if ($request->bearerToken()) {
            $this->purgeToken($request);
        }

        return $this->successResponse('Logout successful. You have been successfully logged out.');

    }

    /**
     * Show client data profile.
     */

    /**
     * Remove the specified client.
     */
    public function destroy(Request $request)
    {
        if (! $request->bearerToken()) {
            throw ValidationException::withMessages([
                'phone' => 'Please ensure you have the necessary permissions to perform this action.',
            ]);
        }
        # delete tokens
        $this->purgeToken($request);

        # delete addresses
        Client::find($request->user()->id)->addresses()->forceDelete();

        // destroy main account user.
        $request->user()->forceDelete();

        return $this->successResponse('Your profile and addresses are permanently deleted.', 205);
    }

    /**
     * @param $request
     * @return bool
     * Revoke all tokens.
     */
    public function purgeToken($request): bool
    {
        return $request->user()->tokens()->delete();
    }
}
