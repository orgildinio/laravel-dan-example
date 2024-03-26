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
            'count' => 100,
            'u' => 'smart_39',
            'p' => 'SmartUser2023*',
            'api_key' => 0
        ];
        $response = Http::get('http://103.87.69.87:80/GS/ServiceE', $params);
        dd($response);
    }
}
