<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SourceComplaintController extends Controller
{
    public function sourceComplaints()
    {
        $params = [
            'action' => 'get-tickets',
            'count' => 30,
            'u' => 'smart_42',
            'p' => 'OYGNvAnwZ',
            'api_key' => 0
        ];
        $response = Http::get('https://www.11-11.mn/GStest/APIa', $params);

        $responseData = $response->getBody()->getContents();

        // Convert the JSON response to an array
        $dataArray = json_decode($responseData, true);
        $data = $dataArray['smart'];

        // Initialize an empty array for the converted data
        $complaints = [];

        // Iterate through the 'smart' array to create the desired format
        foreach ($data['smart']['created_at'] as $key => $value) {
            $complaints[] = [
                "created_at" => $data['smart']['created_at'][$key],
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

        return view('source.index', compact('complaints'));
    }
}
