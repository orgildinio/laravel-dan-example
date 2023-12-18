<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class DanAuthController extends Controller
{
    public function redirectToDan()
    {
        return Socialite::driver('dan')->redirect();
    }

    public function handleDanCallback()
    {
        $danUser = Socialite::driver('dan')->user();
        dd($danUser);

        // Check if the user already exists in your database
        // $user = User::where('email', $danUser->email)->first();

        // if (!$user) {
        //     // If the user doesn't exist, create a new user in your database
        //     $user = User::create([
        //         'name' => $danUser->name,
        //         'email' => $danUser->email,
        //         // Add any other fields you want to store
        //     ]);
        // }

        // Auth::login($user, true);

        return redirect()->route("welcome")->with('success', 'Амжилттай нэвтэрлээ.');
    }
}