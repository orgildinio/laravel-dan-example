<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\File;
use App\Models\Channel;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\EnergyType;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\ComplaintType;
use App\Http\Livewire\ComplaintStep;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\ComplaintStoreRequest;
use App\Models\ComplaintStep as ModelsComplaintStep;
use App\Models\ComplaintTypeSummary;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function complaints()
    {
        // $complaints = Complaint::latest()->get();

        // return view('complaints.complaints', compact('complaints'));

        $complaints = Complaint::latest()->paginate(5);

        return view('complaints.complaints', compact('complaints'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function addComplaint()
    {
        $categories = Category::all();
        $orgs = Organization::all();
        $complaint_types = ComplaintType::all();
        $energy_types = EnergyType::all();

        return view('complaints.addComplaint', compact('categories', 'orgs', 'complaint_types', 'energy_types'));
    }

    public function getOrg(Request $request)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');

        $coords = ["lat" => $lat, "lng" => $lng];

        // try {
        //     // Send Http request to get org_id
        //     $response = Http::withHeaders(['Content-Type' => 'application/json'])->get('http://172.20.10.11:3000/consumer/api/building/heat-provider?lat=' . $lat . '&lng=' . $lng);

        //     $result = $response->json();
        //     // dd($result[0]["id"]);
        //     $org_id = $result[0]["id"];
        // } catch (Exception $e) {
        //     $org_id = 1;
        //     return [
        //         'ok' => false,
        //         'message' => $e->getMessage()
        //     ];
        // }
        $response = Http::withHeaders(['Content-Type' => 'application/json'])->get('http://172.20.10.11:3000/consumer/api/building/heat-provider?lat=' . $lat . '&lng=' . $lng);

        $result = $response->json();
        // dd($result);
        if (!empty($result)) {
            $org_id = $result[0]["id"];
        } else {
            $org_id = 1;
        }


        $orgData = Organization::findOrFail($org_id);
        // dd($orgData);

        return response()->json($orgData);
    }

    public function showComplaint($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint_steps = ModelsComplaintStep::where('complaint_id', $id)->get();

        // dd($complaint_steps);
        return view('complaints.showComplaint', compact('complaint', 'complaint_steps'));
    }

    public function index()
    {
        $complaints = Complaint::latest()->paginate(5);

        return view('complaints.index', compact('complaints'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function complaintStatus($status_id)
    {
        $org_id = Auth::user()->org_id;

        $complaints = Complaint::where('status_id', $status_id)->where('organization_id', $org_id)->latest()->paginate(5);

        return view('complaints.indexDetail', compact('complaints'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $orgs = Organization::orderBy('name', 'asc')->get();;
        $channels = Channel::all();
        $complaint_types = ComplaintType::all();
        $energy_types = EnergyType::all();
        $complaint_type_summaries = ComplaintTypeSummary::all();

        return view('complaints.create', compact('categories', 'orgs', 'channels', 'complaint_types', 'energy_types', 'complaint_type_summaries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();

        if ($file = $request->file('file')) {
            $name = time() . $file->getClientOriginalName();

            $file->move('files', $name);
            $filename = File::create(['filename' => $name]);

            $input['file_id'] = $filename->id;
        }
        if ($audio_file = $request->file('audio_file')) {
            $name = time() . $audio_file->getClientOriginalName();

            $audio_file->move('files', $name);
            $filename = File::create(['filename' => $name]);

            $input['audio_file_id'] = $filename->id;
        }

        // if ($input['channel_id'] == null) $input['channel_id'] = 1;
        $input['channel_id'] = 1;
        $input['status_id'] = 0;
        $input['created_user_id'] = $user->id;

        Complaint::create($input);

        return redirect()->route('complaints')->with('success', 'Санал хүсэлт амжилттай бүртгэлээ.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint_steps = ModelsComplaintStep::where('complaint_id', $id)->get();

        // dd($complaint_steps);
        return view('complaints.show', compact('complaint', 'complaint_steps'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $complaint = Complaint::findOrFail($id);
        $categories = Category::all();
        $orgs = Organization::all();
        $channels = Channel::all();
        $complaint_types = ComplaintType::all();
        $energy_types = EnergyType::all();

        return view('complaints.edit', compact('complaint', 'categories', 'orgs', 'channels', 'complaint_types', 'energy_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ComplaintStoreRequest $request, $id)
    {
        $complaint = Complaint::findOrFail($id);
        $user = Auth::user();
        $input = $request->all();

        if ($file = $request->file('file')) {
            $name = time() . $file->getClientOriginalName();

            $file->move('files', $name);
            $filename = File::create(['filename' => $name]);

            $input['file_id'] = $filename->id;
        }

        $input['status_id'] = 0;
        $input['updated_user_id'] = $user->id;

        // dd($input);

        $complaint->update($input);

        return redirect()->route('complaint.index')->with('success', 'Амжилттай хадгаллаа.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);

        $complaint->delete();

        return redirect()->route('complaint.index')->with('success', 'Амжилттай устгалаа.');
    }
}