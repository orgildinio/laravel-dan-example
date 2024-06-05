<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintStepResource;
use App\Models\ComplaintStep;
use Illuminate\Http\Request;

class ComplaintStepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaintSteps = ComplaintStep::latest()->take(10)->get();
        return ComplaintStepResource::collection($complaintSteps);
    }

    public function getStepsByComplaintId($complaint_id)
    {
        $complaintSteps = ComplaintStep::where("complaint_id", $complaint_id)->get();
        // dd($complaintSteps);
        return ComplaintStepResource::collection($complaintSteps);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComplaintStep  $complaintStep
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintStep $complaintStep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComplaintStep  $complaintStep
     * @return \Illuminate\Http\Response
     */
    public function edit(ComplaintStep $complaintStep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComplaintStep  $complaintStep
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComplaintStep $complaintStep)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComplaintStep  $complaintStep
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintStep $complaintStep)
    {
        //
    }
}
