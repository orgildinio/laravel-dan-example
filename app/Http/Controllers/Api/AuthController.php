<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginApiRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Check if regnum is not null
        // if ($request->regnum != null) {
        //     $user = User::where('danRegnum', $request->regnum)->first();
        // } else {
        //     return response()->json([
        //         'status' => "Not valid data",
        //     ], 400); // Use a 400 Bad Request status code for invalid data
        // }

        $user = User::where('danRegnum', $request->regnum)->first();

        // If user does not exist, create a new user
        if (!$user) {
            $user = User::create([
                'name' => $request->firstname,
                'danImage' => $request->image,
                'danFirstname' => $request->firstname,
                'danLastname' => $request->lastname,
                'danRegnum' => $request->regnum,
                'danAimagCityName' => $request->aimagCityName,
                'danSoumDistrictName' => $request->soumDistrictName,
                'danBagKhorooName' => $request->bagKhorooName,
                'danPassportAddress' => $request->passportAddress,
                "danGender" => $request->gender,
                'password' => Hash::make(123456),
                'role_id' => 5
            ]);
        }

        // Generate an authentication token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return the response with the token and user data
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        // Revoke the token that was used to authenticate the current request
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    public function user(Request $request)
    {
        return $request->user();
    }
}