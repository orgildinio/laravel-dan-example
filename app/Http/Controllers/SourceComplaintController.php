<?php

namespace App\Http\Controllers;

use App\Models\SourceComplaint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SourceComplaintController extends Controller
{
    public function fetchComplaints()
    {
        $params = [
            'action' => 'get-tickets',
            'count' => 30,
            'u' => 'smart_42',
            'p' => 'OYGNvAnwZ',
            'api_key' => 0
        ];
        $response = Http::get('https://www.11-11.mn/GStest/APIa', $params);

        // Check if API request was successful (status code 200)
        if ($response->successful()) {
            // $data = $response->json(); // Convert response to JSON
            $responseData = $response->getBody()->getContents();

            // Convert the JSON response to an array
            $dataArray = json_decode($responseData, true);
            $data = $dataArray['smart'];
            dd($data);

            // Initialize an empty array for the converted data
            $complaints = [];

            // Iterate through the 'smart' array to create the desired format
            foreach ($data['smart']['created_at'] as $key => $value) {
                $complaints[] = [
                    "created_date" => Carbon::createFromFormat('M d, Y h:i:s A', $data['smart']['created_at'][$key]),
                    "source" => $data['smart']['source'][$key],
                    "quarter" => $data['smart']['quarter'][$key],
                    "assigned_at" => $data['smart']['assigned_at'][$key],
                    "number" => $data['smart']['number'][$key],
                    "city" => $data['smart']['city'][$key],
                    "register_no" => $data['smart']['register_no'][$key],
                    "phone" => $data['smart']['phone'][$key],
                    "content" => $data['smart']['content'][$key],
                    "email" => $data['smart']['email'][$key],
                    "type" => $data['smart']['type'][$key],
                    "address" => $data['smart']['address'][$key],
                    "district" => $data['smart']['district'][$key],
                    "fullname" => $data['smart']['fullname'][$key],
                    "path" => $data['smart']['path'][$key],
                ];
            }

            // // Loop through the data and check if each item already exists in the database
            // foreach ($complaints as $item) {
            //     // Check if data already exists based on a unique identifier (e.g., ID, email, etc.)
            //     $existingItem = SourceComplaint::where('number', $item['number'])->first();

            //     if (!$existingItem) {
            //         // Data doesn't exist, so create a new record in the database
            //         SourceComplaint::create($item);
            //     }
            // }

            return response()->json(['message' => 'Data fetched and stored successfully.']);
        } else {
            // API request failed
            return response()->json(['error' => 'Failed to fetch data from API.'], 500);
        }
    }

    public function index(Request $request)
    {
        $daterange = $request->query('daterange');
        $search_text = $request->query('search_text');
        $selected_year = $request->query('year');
        $serial_number = $request->query('serial_number');

        $query = SourceComplaint::query();

        if (!empty($selected_year)) {
            $query->whereYear('created_date', $selected_year);
        } else {
            $currentYear = now()->year;
            $query->whereYear('created_date', $currentYear);
        }

        if (!empty($search_text)) {
            $query->where('content', 'LIKE', '%' . $search_text . '%');
        }
        if (!empty($serial_number)) {
            $query->where('number', 'LIKE', '%' . $serial_number . '%');
        }

        if (!empty($daterange)) {
            $dates = explode(' to ', $daterange);
            $start_date = $dates[0];
            $end_date = $dates[1];

            $query->whereBetween('created_date', [$start_date, $end_date]);
        }

        $complaints = $query->orderBy('created_date', 'desc')->paginate(15);

        // Append filter parameters to pagination links
        $complaints->appends($request->query());

        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 5, -1);

        return view('source.index', compact('complaints', 'serial_number', 'selected_year', 'daterange', 'search_text', 'years'));
    }
}
