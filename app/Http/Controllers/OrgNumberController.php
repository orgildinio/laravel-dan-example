<?php

namespace App\Http\Controllers;

use App\Models\OrganizationNumbers;
use Illuminate\Http\Request;

class OrgNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $organizationId = $request->get('organization_id');
        return view('org_numbers.create', compact('organizationId'));
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

        $request->validate([
            'phone_number' => 'required',
            'organization_id' => 'required',
        ]);

        OrganizationNumbers::create($input);
        return redirect()->route('organization.index')
            ->with('success', 'Амжилттай хадгаллаа.');
    }

    public function save(Request $request, $org_id)
    {
        $input = $request->all();
        // dd($input['phone_number']);

        $request->validate([
            'phone_number' => 'required'
        ]);

        OrganizationNumbers::create([
            'phone_number' => $input['phone_number'],
            'organization_id' => $org_id,
        ]);
        return redirect()->route('organization.index')
            ->with('success', 'Амжилттай хадгаллаа.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orgNumber = OrganizationNumbers::findOrFail($id);
        return view('org_numbers.edit', compact('orgNumber'));
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
        $input = $request->all();

        $request->validate([
            'phone_number' => 'required',
            'organization_id' => 'required',
        ]);

        $orgNumber = OrganizationNumbers::findOrFail($id);
        $orgNumber->update($input);

        return redirect()->route('organization.show', $orgNumber->organization_id)
            ->with('success', 'Амжилттай шинэчиллээ.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orgNumber = OrganizationNumbers::findOrFail($id);
        $orgNumber->delete();
    }

    public function forward(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:organization_numbers,id',
            'forwarded_number' => 'nullable|string|max:20'
        ]);

        $number = OrganizationNumbers::findOrFail($request->id);
        $number->forwarded_number = $request->forwarded_number;
        $number->save();

        return response()->json(['message' => 'Дугаар амжилттай шилжүүлэгдлээ.']);
    }

    public function clearForwarded($id)
    {
        $number = OrganizationNumbers::findOrFail($id);
        $number->forwarded_number = null;
        $number->save();

        return back()->with('success', 'Шилжүүлсэн дугаар амжилттай цуцлагдлаа.');
    }
}
