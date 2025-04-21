<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PushTokenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $user = auth()->user(); // or find user by some ID
        $user->expo_token = $request->token;
        $user->save();

        return response()->json(['message' => 'Token saved']);
    }
}
