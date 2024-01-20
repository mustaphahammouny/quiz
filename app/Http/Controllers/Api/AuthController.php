<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $token = Auth::user()->createToken('desktop');

        return response()->json(['token' => $token->plainTextToken]);
    }

    public function logout()
    {
        $user = Auth::user();

        $user->currentAccessToken()->delete();
    }
}
