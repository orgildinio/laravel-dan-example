<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Organization::query();

        if ($request->filled('org_id')) {
            $query->where('id', $request->org_id);
        }

        // Filter by plant_id
        if ($request->filled('plant_id')) {
            $query->where('plant_id', $request->plant_id);
        }

        $orgs = $query->with('orgNumber')->orderBy('name', 'asc')->paginate(15)->appends($request->query());

        return view('organizations.index', compact('orgs'))
            ->with('i', (request()->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'plant_id' => 'required',
        ]);

        Organization::create($request->all());

        return redirect()->route('organization.index')
            ->with('success', 'Байгууллага амжилттай бүртгэгдлээ.');
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
    public function edit(Organization $organization)
    {
        return view('organizations.edit', compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        $request->validate([
            'name' => 'required',
            'plant_id' => 'required',
        ]);

        $organization->update($request->all());

        return redirect()->route('organization.index')
            ->with('success', 'Мэдээлэл амжилттай засагдлаа.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();

        return redirect()->route('organization.index')
            ->with('success', 'Байгууллага амжилттай устгагдлаа');
    }
}
