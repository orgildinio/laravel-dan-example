<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\EnergyType;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\ComplaintType;
use App\Models\DanUser;
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

        $danUserModel = DanUser::create([
            'personId' => $danUser->personId,
            'firstname' => $danUser->firstname,
            'lastname' => $danUser->lastname,
            'regnum' => $danUser->regnum,
            'aimagCityName' => $danUser->aimagCityName,
            'soumDistrictName' => $danUser->soumDistrictName,
            'bagKhorooName' => $danUser->bagKhorooName,
            'passportAddress' => $danUser->passportAddress,
            'image' => $danUser->image,
            "gender" => $danUser->gender,
            "user_id" => 5
        ]);

        $appUser = User::where('id', 5)->first();
        $appUser->update([
            'name' => $danUser->firstname,
            'danImage' => $danUser->image
        ]);

        // dd($danUser);

        Auth::loginUsingId(5, true);

        // Auth::login($user, true);

        return redirect()->route("welcome")->with('success', 'Амжилттай нэвтэрлээ.');
    }
}
