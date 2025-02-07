<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\BagKhoroo;
use App\Models\Organization;
use App\Models\SoumDistrict;
use Illuminate\Http\Request;
use App\Models\OrganizationServiceArea;

class OrganizationServiceAreaController extends Controller
{
    public function index()
    {
        $serviceAreas = OrganizationServiceArea::with(['organization', 'country', 'soumDistrict', 'bagKhoroo'])->latest()->paginate(25);
        return view('organization_service_areas.index', compact('serviceAreas'));
    }


    public function add($organization_id)
    {
        $organization = Organization::findOrFail($organization_id);
        $countries = Country::all();
        $soums = SoumDistrict::all();
        $bags = BagKhoroo::all();

        return view('organizations.service_area_form', compact('organization', 'countries', 'soums', 'bags'));
    }

    public function save(Request $request, $organization_id)
    {
        // Validate request
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'soum_district_id' => 'required|array|min:1', // At least one Soum/District must be selected
            'soum_district_id.*' => 'exists:soum_districts,id',
            'bag_khoroo_id' => 'required|array|min:1', // At least one Bag/Khoroo must be selected
            'bag_khoroo_id.*' => 'exists:bag_khoroos,id',
        ]);

        $organization = Organization::findOrFail($organization_id);

        // Save new service areas for BagKhoroo
        foreach ($request->bag_khoroo_id as $bag_id) {
            $bag = BagKhoroo::findOrFail($bag_id); // Ensure the record exists

            OrganizationServiceArea::firstOrCreate([
                'organization_id' => $organization->id,
                'bag_khoroo_id' => $bag_id
            ], [
                'country_id' => $bag->soumDistrict->country_id,
                'soum_district_id' => $bag->soum_district_id,
            ]);
        }

        return redirect()->route('organizationServiceArea.index')
            ->with('success', 'Service area saved successfully.');
    }


    public function destroy($id)
    {
        $serviceArea = OrganizationServiceArea::findOrFail($id);
        $serviceArea->delete();

        return redirect()->route('organizationServiceArea.index')->with('success', 'Service area deleted successfully.');
    }
}
