<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\traits\apiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Handle Response for Methods
     * Type : Trait
     */

    use apiResponseTrait;

    /**
     * Register User.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:10|min:2',
            'email' => 'required|string|email:rfc,filter|max:255|unique:users',
            // Password should made up of 8 characters, numbers, letters and special characters.
            'password' => 'required|string|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/|regex:/^\S*$/|max:50',
        ]);
        if ($validator->fails()) {
            return $this->responseError($validator->errors()->all(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($user) {
            $token = $user->createToken("API TOKEN")->plainTextToken;
            return $this->responseSucsses(['token' => $token, 'user' => $user], 202);
        }

        return $this->responseError('Bad Request', 400);
    }

    /**
     * Login the user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email:rfc,filter|max:50',
            'password' => 'required|max:30',
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->errors()->all(), 422);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = User::where('email', $request->email)->first();

            $token = $user->createToken("API TOKEN")->plainTextToken;

            return $this->responseSucsses(['token' => $token, 'user' => $user]);
        }
        return $this->responseError('These credentials do not match our records.', 422);
    }

    /**
     * Logout the user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->responseSucsses(null);
    }
}
