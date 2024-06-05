<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ComplaintType;
use Illuminate\Http\Request;

class ComplaintTypeController extends Controller
{
    public function index()
    {
        return response()->json(ComplaintType::all());
    }
}
