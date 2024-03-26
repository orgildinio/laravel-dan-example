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
        dd($response->json());
        // $results = $response->json();




    }
}
