<?php

namespace App\Http\Controllers\Api;

use App\Models\BagKhoroo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BagKhorooController extends Controller
{
    public function index()
    {
        $bags = BagKhoroo::all();
        return response()->json($bags);
    }

    public function getBags(Request $request)
    {
        // // Validate the incoming request for soum_ids
        // $request->validate([
        //     'soum_ids' => 'required|array',
        //     'soum_ids.*' => 'exists:soum_districts,id',
        // ]);

        // $soumIds = $request->input('soum_ids');

        // // Fetch bags based on selected soums
        // $bags = BagKhoroo::whereIn('soum_district_id', $soumIds)->get();

        // return response()->json([
        //     'bags' => $bags,
        // ]);
        try {
            $soumIds = explode(',', $request->query('soum_ids', ''));
            if (empty($soumIds)) {
                return response()->json(['bags' => []]);
            }

            $bags = BagKhoroo::whereIn('soum_district_id', $soumIds)->get(['id', 'name']);
            return response()->json(['bags' => $bags]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
