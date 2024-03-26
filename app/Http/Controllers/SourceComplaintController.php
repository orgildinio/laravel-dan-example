<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SourceComplaintController extends Controller
{
    public function sourceComplaints()
    {
        $response = Http::get('http://103.87.69.87:80/GS/ServiceE?action=get-tickets&count=100&u=smart_39&p=SmartUser2023*&api_key=0');
        dd($response->json());
    }
}
