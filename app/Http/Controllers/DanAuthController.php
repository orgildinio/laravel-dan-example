<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class DanAuthController extends Controller
{
    public function redirectToDan()
    {
        $service_structure = [
            "services" => [
                "WS100101_getCitizenIDCardInfo",
            ],
            "wsdl" => "https://xyp.gov.mn/citizen-1.3.0/ws?WSDL",
        ];
        $jsonString = json_encode($service_structure);

        $scope = base64_encode($jsonString);

        // dd($scope);

        return Socialite::driver('dan')->redirect();
    }

    public function handleDanCallback()
    {
        $user = Socialite::driver('dan')->user();
        dd($user);

        Auth::login($user, true);

        return redirect()->route("welcome")->with('success', 'Амжилттай нэвтэрлээ.');
    }
}