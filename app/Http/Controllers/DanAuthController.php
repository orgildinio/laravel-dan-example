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

        $user = User::where('danRegnum', $danUser->regnum)->first();

        if (!$user) {
            // If the user doesn't exist, create a new user in your database
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
            "user_id" => $user->id
        ]);

        // $appUser = User::where('id', 5)->first();
        // $appUser->update([
        //     'name' => $danUser->firstname,
        //     'danImage' => $danUser->image
        // ]);

        // dd($danUser);

        Auth::loginUsingId($user->id, true);

        // Auth::login($user, true);

        return redirect()->route("welcome")->with('success', 'Амжилттай нэвтэрлээ.');
    }
}
