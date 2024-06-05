<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ComplaintTypeSummary;
use Illuminate\Http\Request;

class ComplaintTypeSummaryController extends Controller
{
    public function index()
    {
        return response()->json(ComplaintTypeSummary::all());
    }
}
