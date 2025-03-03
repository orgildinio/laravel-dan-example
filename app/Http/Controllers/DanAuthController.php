<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Laravel\Socialite\Facades\Socialite;

class DanAuthController extends Controller
{
    public function redirectToDan()
    {
        $json = '[{"services": ["WS100101_getCitizenIDCardInfo"], "wsdl": "https://xyp.gov.mn/citizen-1.3.0/ws?WSDL"}]';

        $scope = base64_encode($json);

        return Socialite::driver('dan')->scopes($scope)->redirect();
    }

    public function redirectToDanOrg()
    {
        $json = '[{"services": ["WS100307_getLegalEntityInfoWithRegnum"], "wsdl": "https://xyp.gov.mn/legal-entity-1.3.0/ws?WSDL"}]';

        $scope = base64_encode($json);

        return Socialite::driver('dan')->scopes($scope)->redirect();
    }


    public function handleDanCallback(Request $request)
    {
        // dd(Socialite::driver('dan'));

        if ($request->has('error')) {
            // Handle the error case (user refused the authentication)
            return redirect()->route('login')->withErrors(['message' => 'Authentication was canceled. Please try again.']);
        }

        $danUser = Socialite::driver('dan')->user();

        if ($danUser->login_type == 1) {

            $user = User::where('companyRegnum', $danUser->regnum)->first();

            if (!$user) {
                // If the user doesn't exist, create a new user in your database
                // session(['first_dan_login' => true]);
                $user = User::create([
                    'name' => $danUser->companyName,
                    'companyName' => $danUser->companyName . " " . $danUser->description,
                    'companyRegnum' => $danUser->regnum,
                    'companyType' => $danUser->ownershipTypeName . ", " . $danUser->profitTypeName,
                    'danAimagCityName' => $danUser->aimagCityName,
                    'danSoumDistrictName' => $danUser->soumDistrictName,
                    'danBagKhorooName' => $danUser->bagKhorooName,
                    'password' => Hash::make(123456),
                    'role_id' => 5
                ]);
            }

            // Auth::loginUsingId($user->id, true);
            Auth::login($user, true);

            return redirect()->route("addComplaint")->with('success', 'Амжилттай нэвтэрлээ.');
        } else {
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

            // Auth::loginUsingId($user->id, true);
            Auth::login($user, true);

            return redirect()->route("addComplaint")->with('success', 'Амжилттай нэвтэрлээ.');
        }
    }
}
