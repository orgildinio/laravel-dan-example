<?php

namespace App\Http\Controllers;

use App\Models\OrgUserData;
use Illuminate\Http\Request;
use App\Imports\OrgUserDataImport;
use App\Models\Organization;
use Maatwebsite\Excel\Facades\Excel;

class OrgUserDataImportController extends Controller
{
    public function index()
    {
        $orgUserData = OrgUserData::orderBy('org_id', 'asc')->paginate(100); // Fetch all records
        $organizations = Organization::orderBy('name', 'asc')->get();

        return view('org-user-data.index', compact('orgUserData', 'organizations'));
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
            'org_id' => 'required|exists:organizations,id',
        ]);

        $orgId = $request->input('org_id');

        Excel::import(new OrgUserDataImport($orgId), $request->file('file'));

        return redirect()->back()->with('success', 'Мэдээлэл амжилттай хадгалагдлаа!');
    }
}
