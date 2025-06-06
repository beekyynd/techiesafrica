<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthenticatedSessionController extends Controller

{
    /**
     * Handle an incoming authentication request.
     */

    public function store(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $request->authenticate();
            $user = $request->user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $user
            ]);
        } 
        
        catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Invalid credentials',
                'errors' => [
                    'email' => [$e->getMessage()],
                ],
            ], 422);
        } 
        
    }

    /**
     * Destroy Auth token
     */

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        if($request->user()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
