<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DanUser;
use App\Models\Category;
use App\Models\EnergyType;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\ComplaintType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        // dd($danUser);

        $user = User::where('danRegnum', $danUser->regnum)->first();

        if (!$user) {
            // If the user doesn't exist, create a new user in your database
            session(['first_dan_login' => true]);
            $user = User::create([
                'name' => $danUser->firstname,
                'danImage' => $danUser->image,
                'danFirstname' => $danUser->firstname,
                'danLastname' => $danUser->lastname,
                'danRegnum' => $danUser->regnum,
                'danAimagCityName' => $danUser->aimagCityName,
                'danSoumDistrictName' => $danUser->soumDistrictName,
                'danBagKhorooName' => $danUser->bagKhorooName,
                'danPassportAddress' => $danUser->passportAddress,
                "danGender" => $danUser->gender,
                'password' => Hash::make(123456),
                'role_id' => 5
            ]);
        }

        Auth::loginUsingId($user->id, true);

        return redirect()->route("welcome")->with('success', 'Амжилттай нэвтэрлээ.');
    }

    public function redirectToDanOrg()
    {
        return Socialite::driver('dan')->scopes(['W3sic2VydmljZXMiOiBbIldTMTAwMzAxX2dldExlZ2FsRW50aXR5SW5mbyJdLCAid3NkbCI6ICJodHRwczovL3h5cC5nb3YubW4vbGVnYWwtZW50aXR5LTEuMy4wL3dzP1dTREwifV0='])->redirect();
    }

    public function handleDanOrgCallback()
    {
        $danUser = Socialite::driver('dan')->user();

        dd($danUser);
    }
}
