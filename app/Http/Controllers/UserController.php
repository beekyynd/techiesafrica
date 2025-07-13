<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getHistory()
    {
        $user = Auth::user();

        // Check if authenticated
        if (!$user) {
            return response()->json([
                'error' => 'Unauthorized access. Please log in.'
            ], 401);
        }

        // Fetch user's history
        
        $history = $user->history()->select('id', 'generated_number', 'credits_used', 'created_at')->get();

        return response()->json($history);
    }

    public function updateUser(Request $request)
{
    $user = Auth::user();

    // Check if authenticated
    if (!$user) {
        return response()->json([
            'error' => 'Unauthorized access. Please log in.'
        ], 401);
    }

    // Validate password input
    $request->validate([
        'password' => 'required|string|min:6',
    ]);

    // Update the password
    $user->password = Hash::make($request->input('password'));
    $user->save();

    return response()->json([
        'message' => 'Password updated successfully'
    ]);
}
}
