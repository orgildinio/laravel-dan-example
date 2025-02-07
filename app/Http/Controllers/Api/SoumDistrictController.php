<?php

namespace App\Http\Controllers\Api;

use App\Models\SoumDistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SoumDistrictController extends Controller
{
    public function index()
    {
        $soums = SoumDistrict::all();
        return response()->json($soums);
    }

    public function getSoums(Request $request)
    {
        // dd($request->all());
        // Validate the incoming request for country_id
        $request->validate([
            'country_id' => 'required|exists:countries,id',
        ]);

        $countryId = $request->input('country_id');

        // Fetch soums based on country_id
        $soums = SoumDistrict::where('country_id', $countryId)->get();

        return response()->json([
            'soums' => $soums,
        ]);
    }
}
