<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintStoreRequest;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\File;
use App\Models\Organization;
use Illuminate\Http\Request;

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
        return view('complaints.create', compact('categories', 'orgs'));
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
        return view('complaints.create', compact('categories', 'orgs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplaintStoreRequest $request)
    {
        // dd($request);
        $input = $request->all();

        if ($file = $request->file('file')) {
            $name = time() . $file->getClientOriginalName();

            $file->move('files', $name);
            $filename = File::create(['filename' => $name]);

            $input['file_id'] = $filename->id;
        }
        $input['channel_id'] = 1;
        $input['status_id'] = 0;

        Complaint::create($input);

        return redirect()->route('complaint.create')->with('success', 'Санал хүсэлт амжилттай бүртгэлээ.');
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
        return view('complaints.show', compact('complaint'));
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
        return view('complaints.edit', compact('complaint'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
        ]);

        $complaint->fill($request->post())->save();
        return redirect()->route('complaints.index')->with('success', 'Амжилттай хадгаллаа.');
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

        return redirect()->route('complaints.index')->with('success', 'Амжилттай устгалаа.');
    }
}
