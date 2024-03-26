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
        // $response = Http::get('https://www.11-11.mn/GStest/APIa?action=get-tickets&count=30&u=smart_42&p=OYGNvAnwZ&api_key=0');
        // $response = Http::get('http://103.87.69.87/GStest/APIa?action=get-tickets&count=30&u=smart_42&p=OYGNvAnwZ&api_key=0');
        // dd($response);
        $responseData = $response->getBody()->getContents();

        // Convert the JSON response to an array
        $dataArray = json_decode($responseData, true);
        // dd($dataArray);

        // // Convert JSON string to PHP array
        // $data = json_decode($results, true);

        // Initialize an empty array for the converted data
        $convertedData = [];

        // Iterate through the 'smart' array to create the desired format
        foreach ($dataArray['smart']['created_at'] as $key => $value) {
            $convertedData[] = [
                "created_at" => $dataArray['smart']['created_at'][$key],
                "source" => $dataArray['smart']['source'][$key],
                "quarter" => $dataArray['smart']['quarter'][$key],
                // Add other fields here
            ];
        }

        // Encode the converted data back to JSON format if needed
        $convertedJson = json_encode($convertedData, JSON_PRETTY_PRINT);

        // Print or return the converted JSON data
        return $convertedJson;
    }
}
