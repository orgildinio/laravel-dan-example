<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\OrganizationServiceArea;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->query('name');
        $plant_id = $request->query('plant_id');
        $phone = $request->query('phone');

        $query = Organization::query();

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }

        // Filter by plant_id
        if ($request->filled('plant_id')) {
            $query->where('plant_id', $plant_id);
        }

        // Filter by phone number in the orgNumber relationship
        if ($request->filled('phone')) {
            $query->whereHas('orgNumber', function ($q) use ($phone) {
                $q->where('phone_number', 'LIKE', '%' . $phone . '%');
            });
        }

        $orgs = $query->with('orgNumber')->orderBy('name', 'asc')->paginate(15)->appends($request->query());

        return view('organizations.index', compact('orgs'))->with([
            'name' => $request->name,
            'plant_id' => $request->plant_id,
            'phone' => $request->phone,
        ]);
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

    public function getOrganizations(Request $request)
    {
        // dd($request->all());
        $countryId = intval($request->country_id);
        // dd($countryId);
        // $countryId = $request->country_id;

        // Ensure country_id is always filtered
        $query = OrganizationServiceArea::where('country_id', $countryId);

        // SQL-г харах
        // dd($query->toSql(), $query->getBindings());


        if ($request->has('bag_khoroo_id') && $request->bag_khoroo_id != null) {
            $query->where('bag_khoroo_id', $request->bag_khoroo_id);
        } elseif ($request->has('soum_district_id')  && $request->soum_district_id != null) {
            $query->where('soum_district_id', $request->soum_district_id);
        }

        // Debugging: Check what is returned before pluck()
        $organizationServiceAreas = $query->get();
        // dd($organizationServiceAreas);

        if ($organizationServiceAreas->isEmpty()) {
            return response()->json(['message' => 'No matching organizations found', 'countryId' => $countryId], 404);
        }

        // Get organization IDs
        $organizationIds = $organizationServiceAreas->pluck('organization_id')->toArray();
        // dd($organizationIds);

        // Fetch matching organizations
        $organizations = Organization::whereIn('id', $organizationIds)->get();

        return response()->json($organizations);
    }
}
