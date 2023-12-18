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
            "user_id" => 1
        ]);

        // dd($danUser);

        Auth::loginUsingId(1, true);

        // dd($danUser);

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
        // return view('complaints.addComplaint', compact('categories', 'orgs', 'complaint_types', 'energy_types', 'danUser'));
    }
}
