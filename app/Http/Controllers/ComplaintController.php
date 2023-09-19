<?php

namespace App\Http\Controllers;

use App\Http\Livewire\ComplaintStep;
use App\Models\File;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ComplaintStoreRequest;
use App\Models\Channel;
use App\Models\ComplaintStep as ModelsComplaintStep;
use Illuminate\Support\Facades\Redis;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function complaints()
    {
        $complaints = Complaint::all();

        return view('complaints.complaints', compact('complaints'));
    }

    public function addComplaint()
    {
        $categories = Category::all();
        $orgs = Organization::all();
        return view('complaints.addComplaint', compact('categories', 'orgs'));
    }

    public function index()
    {
        $complaints = Complaint::all();

        return view('complaints.index', compact('complaints'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $orgs = Organization::all();
        $channels = Channel::all();
        return view('complaints.create', compact('categories', 'orgs', 'channels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $audio = $request->file('audio');
        // dd($request);
        // dd($request->file('audio_file'));
        $input = $request->all();
        $user = Auth::user();

        if ($file = $request->file('file')) {
            $name = time() . $file->getClientOriginalName();

            $file->move('files', $name);
            $filename = File::create(['filename' => $name]);

            $input['file_id'] = $filename->id;
        }
        if ($file = $request->file('audio_file')) {
            $name = time() . $file->getClientOriginalName();

            $file->move('files', $name);
            $filename = File::create(['filename' => $name]);

            $input['file_id'] = $filename->id;
        }

        // if ($input['channel_id'] == null) $input['channel_id'] = 1;
        $input['channel_id'] = 1;
        $input['status_id'] = 0;
        $input['created_user_id'] = $user->id;

        Complaint::create($input);

        return redirect()->route('complaint.create')->with('success', 'Санал хүсэлт амжилттай бүртгэлээ.');
    }
    public function upload(Request $request)
    {
        dd($request);
        $audio = $request->file('audio');
        $path = $audio->store('uploads');

        return response()->json(['message' => 'Audio uploaded successfully', 'path' => $path]);
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
        return view('complaints.edit', compact('complaint', 'categories', 'orgs', 'channels'));
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
