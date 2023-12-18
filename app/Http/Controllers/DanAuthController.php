<?php

namespace App\Http\Controllers;

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
        $user = Socialite::driver('dan')->user();
        // dd($user->user);

        // Auth::login($user, true);

        return redirect()->route("welcome")->with('success', 'Амжилттай нэвтэрлээ.');
    }
}
