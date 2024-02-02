<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\File;
use App\Models\Soum;
use App\Models\Aimag;
use App\Models\Status;
use App\Models\Channel;
use App\Models\DanUser;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\EnergyType;
use App\Models\Organization;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\ComplaintStep;
use App\Models\ComplaintType;
use App\Exports\ExportComplaint;
use App\Models\ComplaintMakerType;
use Illuminate\Support\Facades\DB;
use App\Models\ComplaintTypeSummary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\Console\Input\Input;
use App\Http\Requests\ComplaintStoreRequest;
use App\Models\ComplaintStep as ModelsComplaintStep;

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

    public function userComplaints()
    {
        $user = Auth::user();

        $complaints = Complaint::where('created_user_id', $user->id)->latest()->paginate(5);

        return view('complaints.userComplaints', compact('complaints'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function addComplaint()
    {
        $danUser = Auth::user();

        $categories = Category::all();
        $orgs = Organization::orderBy('name', 'asc')->get();
        $complaint_types = ComplaintType::all();
        $energy_types = EnergyType::all();

        return view('complaints.addComplaint', compact('categories', 'orgs', 'complaint_types', 'energy_types', 'danUser'));
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
    public function getOrgByEnergyTypeId(Request $request)
    {
        $energy_type_id = $request->input('energy_type_id');

        $data['orgs'] = Organization::where("plant_id", $energy_type_id)
            ->whereNotIn("id", [99])
            ->orderBy("name")
            ->get(["name", "id"]);

        return response()->json($data);
    }
    // Өргөдлийн товч утгыг ajax- аар авах
    public function getTypeSummary(Request $request)
    {
        $energy_type_id = $request->input('energy_type_id');
        $complaint_type_id = $request->input('complaint_type_id');

        $data['summaries'] = ComplaintTypeSummary::get(["name", "id"]);

        if ($request->has('energy_type_id') && $request->has('complaint_type_id')) {
            $data['summaries'] = ComplaintTypeSummary::where("energy_type_id", $energy_type_id)
                ->where("complaint_type_id", $complaint_type_id)
                ->get(["name", "id"]);
        }

        return response()->json($data);
    }
    // Хэрэглэгчийн кодоор дамжуулан хэрэглэгчийн мэдээлэл татах
    public function getUserDataByCode(Request $request)
    {
        $code = $request->input('consumer_code');

        $userdata = Registration::where('code', $code)->first();

        return response()->json($userdata);
    }

    public function showComplaint($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint_steps = ModelsComplaintStep::where('complaint_id', $id)->get();

        // dd($complaint_steps);
        return view('complaints.showComplaint', compact('complaint', 'complaint_steps'));
    }

    public function index(Request $request)
    {
        // dd($request);
        $daterange = $request->query('daterange');
        $search_text = $request->query('search_text');
        $status_id = $request->query('status_id');
        $org_id = $request->query('org_id');
        $energy_type_id = $request->query('energy_type_id');

        $query = Complaint::query();
        $query->orderBy('complaint_date', 'desc');

        if (isset($daterange)) {
            $dates = explode(' to ', $daterange);
            $start_date = $dates[0];
            $end_date = $dates[1];
            $query->whereBetween('complaint_date', [$start_date, $end_date]);
        }

        if ($search_text !== null) {
            $query->where('complaint', 'LIKE', '%' . $search_text . '%');
        }

        if ($status_id !== null) {
            $query->where('status_id', $status_id);
        }

        if ($org_id !== null) {
            $query->where('organization_id', $org_id);
        }

        // Нэвтэрсэн хэрэглэгч ЭХЗХ биш ТЗЭ бол зөвхөн тухайн байгууллагын мэдээллийг харуулна
        $logged_user_org_id = Auth::user()->org_id;
        if ($logged_user_org_id != 99) {
            $query->where('organization_id', $logged_user_org_id);
        }

        if ($energy_type_id !== null) {
            $query->where('energy_type_id', $energy_type_id);
        }

        $complaints = $query->paginate(4);

        $statuses = Status::all();
        $orgs = Organization::orderBy('name', 'asc')->get();
        $energy_types = EnergyType::all();

        return view('complaints.index', compact('complaints', 'daterange', 'search_text', 'statuses', 'status_id', 'org_id', 'orgs', 'energy_type_id', 'energy_types'));
    }

    public function ExportReportExcel(Request $request)
    {
        //    dd($request->all());
        return Excel::download(new ExportComplaint, 'complaints.xlsx');
    }

    public function complaintStatus(Request $request, $status_id)
    {
        $org_id = Auth::user()->org_id;
        $logged_user_id = Auth::user()->id;

        $daterange = $request->query('daterange');
        $search_text = $request->query('search_text');

        if (isset($daterange)) {
            $dates = explode(' to ', $daterange);
            $start_date = $dates[0];
            $end_date = $dates[1];
        } else {
            $start_date = now()->subDay(360);
            $end_date = now();
        }

        if (empty($search_text)) {
            $search_text = "";
        }

        switch ($status_id) {
            case '0':
                // Шинээр ирсэн эсвэл шинээр шилжиж ирсэн
                if (Auth::user()->org_id == 99) {
                    $complaints = Complaint::where('complaint', 'LIKE', '%' . $search_text . '%')
                        ->whereBetween('complaint_date', [$start_date, $end_date])
                        ->where('organization_id', Auth::user()->org_id)
                        ->where('status_id', 0)
                        ->orderBy('complaints.created_at', 'desc')
                        ->paginate(5);
                } else {
                    $complaints = Complaint::where('complaint', 'LIKE', '%' . $search_text . '%')
                        ->whereBetween('complaint_date', [$start_date, $end_date])
                        ->where(function ($query) {
                            $query->where('organization_id', Auth::user()->org_id)
                                ->orWhere('second_org_id', Auth::user()->org_id);
                        })
                        ->where(function ($query) {
                            $query->where('status_id', 0)
                                ->orWhere('second_status_id', 0);
                        })
                        ->orderBy('complaints.created_at', 'desc')
                        ->paginate(5);
                }
                break;
            case '1':
                // Шинээр ирсэн эсвэл шинээр шилжиж ирсэн
                $complaints = Complaint::where('complaint', 'LIKE', '%' . $search_text . '%')
                    ->whereBetween('complaint_date', [$start_date, $end_date])
                    ->where('organization_id', Auth::user()->org_id)
                    ->where('status_id', 1)
                    ->where('controlled_user_id', Auth::user()->id)
                    ->orderBy('complaints.created_at', 'desc')
                    ->paginate(5);
                break;
            case '2':
                // Хүлээн авсан
                if (Auth::user()->org_id == 99) {

                    $complaints = Complaint::where('complaint', 'LIKE', '%' . $search_text . '%')
                        ->whereBetween('complaint_date', [$start_date, $end_date])
                        ->where('organization_id', Auth::user()->org_id)
                        ->where('status_id', 2)
                        ->where('controlled_user_id', Auth::user()->id)
                        ->orderBy('complaints.created_at', 'desc')
                        ->paginate(5);
                } else {
                    $complaints = Complaint::where('complaint', 'LIKE', '%' . $search_text . '%')
                        ->whereBetween('complaint_date', [$start_date, $end_date])
                        ->where(function ($query) {
                            $query->where('organization_id', Auth::user()->org_id)
                                ->orWhere('second_org_id', Auth::user()->org_id);
                        })
                        ->where(function ($query) {
                            $query->where('status_id', 2)
                                ->orWhere('second_status_id', 2);
                        })
                        ->where(function ($query) {
                            $query->where('controlled_user_id', Auth::user()->id)
                                ->orWhere('second_user_id', Auth::user()->id);
                        })
                        ->orderBy('complaints.created_at', 'desc')
                        ->paginate(5);
                }
                break;
            case '3':
                // Хянаж байгаа
                if (Auth::user()->org_id == 99) {
                    $complaints = Complaint::where('complaint', 'LIKE', '%' . $search_text . '%')
                        ->whereBetween('complaint_date', [$start_date, $end_date])
                        ->where('organization_id', Auth::user()->org_id)
                        ->where('status_id', 3)
                        ->where('controlled_user_id', Auth::user()->id)
                        ->orderBy('complaints.created_at', 'desc')
                        ->paginate(5);
                } else {

                    $complaints = Complaint::where('complaint', 'LIKE', '%' . $search_text . '%')
                        ->whereBetween('complaint_date', [$start_date, $end_date])
                        ->where(function ($query) {
                            $query->where('organization_id', Auth::user()->org_id)
                                ->orWhere('second_org_id', Auth::user()->org_id);
                        })
                        // ->where('status_id', 3)
                        ->where(function ($query) {
                            $query->where('status_id', 3)
                                ->orWhere('second_status_id', 3);
                        })
                        // ->whereNull('second_status_id')
                        ->where(function ($query) {
                            $query->where('controlled_user_id', Auth::user()->id)
                                ->orWhere('second_user_id', Auth::user()->id);
                        })
                        ->orderBy('complaints.created_at', 'desc')
                        ->paginate(5);
                }
                break;
            case '4':
                // Цуцалсан
                $complaints = Complaint::where('complaint', 'LIKE', '%' . $search_text . '%')
                    ->whereBetween('complaint_date', [$start_date, $end_date])
                    ->where('status_id', $status_id)
                    ->where('organization_id', $org_id)
                    ->where('controlled_user_id', $logged_user_id)
                    ->latest()
                    ->paginate(5);
                break;
            case '6':
                // Шийдвэрлэсэн
                if (Auth::user()->org_id == 99) {
                    $complaints = Complaint::where('complaint', 'LIKE', '%' . $search_text . '%')
                        ->whereBetween('complaint_date', [$start_date, $end_date])
                        ->where('organization_id', Auth::user()->org_id)
                        ->where('status_id', 6)
                        ->where('controlled_user_id', Auth::user()->id)
                        ->orderBy('complaints.created_at', 'desc')
                        ->paginate(5);
                } else {

                    $complaints = Complaint::where('complaint', 'LIKE', '%' . $search_text . '%')
                        ->whereBetween('complaint_date', [$start_date, $end_date])
                        ->where(function ($query) {
                            $query->where('organization_id', Auth::user()->org_id)
                                ->orWhere('second_org_id', Auth::user()->org_id);
                        })
                        ->where(function ($query) {
                            $query->where('status_id', 6)
                                ->orWhere('second_status_id', 6);
                        })
                        ->where(function ($query) {
                            $query->where('controlled_user_id', Auth::user()->id)
                                ->orWhere('second_user_id', Auth::user()->id);
                        })
                        ->orderBy('complaints.created_at', 'desc')
                        ->paginate(5);
                }
                break;

            default:
                // Handle the default case or show an error
                break;
        }


        // $complaints = Complaint::where('status_id', $status_id)->where('organization_id', $org_id)->latest()->paginate(5);

        return view('complaints.indexDetail', compact('complaints', 'daterange', 'search_text', 'status_id'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $orgs = Organization::orderBy('name', 'asc')->get();
        $channels = Channel::all();
        $complaint_types = ComplaintType::all();
        $energy_types = EnergyType::all();
        $complaint_type_summaries = ComplaintTypeSummary::all();
        $complaint_maker_types = ComplaintMakerType::all();
        // $aimags = Aimag::orderBy('order', 'asc')->get();
        // $soums = Soum::orderBy('name')->get();

        return view('complaints.create', compact('categories', 'orgs', 'channels', 'complaint_types', 'energy_types', 'complaint_type_summaries', 'complaint_maker_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplaintStoreRequest $request)
    {
        // $request->validate([
        //     'phone' => 'required',
        //     'email' => 'required|email',
        //     'country' => 'required',
        //     'district' => 'required',
        //     'khoroo' => 'required',
        //     'complaint_type_summary_id' => 'required',
        //     'complaint' => 'required',
        // ]);

        $input = $request->all();
        // dd($input);
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

        if ($request->complaint_date == null) {
            $input['complaint_date'] = now();
        }

        // if ($input['channel_id'] == null) {
        //     $input['channel_id'] = 1;
        // }
        // $input['channel_id'] = 1;
        $input['created_user_id'] = $user->id;

        $register_date = Carbon::parse($input['complaint_date']);
        $input['expire_date'] = $register_date->addHours(48);

        if ($user->org_id != null) {
            $input['complaint_maker_type_id'] = 1;
            $input['status_id'] = 2;
            $input['controlled_user_id'] = $user->id;
        } else {
            $input['status_id'] = 0;
        }

        if (!$request->has('channel_id')) {
            $input['channel_id'] = 1;
        }

        if (!isset($input['organization_id'])) {
            $input['organization_id'] = $user->org_id;
        }

        $complaint = Complaint::create($input);

        if (Auth::user()->org_id != null) {
            return redirect()->route('complaint.create')->with('success', 'Санал хүсэлт амжилттай бүртгэлээ.');
        } else {
            return redirect()->route('userComplaints', ['id' => $complaint->id])->with('success', 'Санал хүсэлт амжилттай бүртгэлээ.');
        }
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
        $complaint_type_summaries = ComplaintTypeSummary::all();
        $complaint_maker_types = ComplaintMakerType::all();

        return view('complaints.edit', compact('complaint', 'categories', 'orgs', 'channels', 'complaint_types', 'energy_types', 'complaint_type_summaries', 'complaint_maker_types'));
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
        $request->validate([
            'phone' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'district' => 'required',
            'khoroo' => 'required',
            'complaint_type_summary_id' => 'required',
            'complaint' => 'required',
        ]);

        $complaint = Complaint::findOrFail($id);
        $user = Auth::user();
        $input = $request->all();

        if ($file = $request->file('file')) {
            $name = time() . $file->getClientOriginalName();

            $file->move('files', $name);
            $filename = File::create(['filename' => $name]);

            $input['file_id'] = $filename->id;
        }

        // $input['status_id'] = 0;
        $input['updated_user_id'] = $user->id;

        // dd($input);

        $complaint->update($input);

        return redirect()->route('complaint.index')->with('success', 'Амжилттай хадгаллаа.');
    }
    // Шинээр ирсэн гомдлыг дарах үед хүлээн авсан болгох
    public function updateComplaintStatus($id)
    {
        $user = Auth::user();
        // Find the record by ID
        $record = Complaint::find($id);
        // $recordStep = ComplaintStep::where('complaint_id', $id)->where('status_id', 0)->first();
        // $countSteps = ComplaintStep::where('complaint_id', $id)->count();

        // Update the record with the new data
        if ($record->status_id == 0) {
            $record->update([
                'status_id' => 2,
                'controlled_user_id' => $user->id,
            ]);
            $complaint_step = ComplaintStep::create([
                'org_id' => $user->org_id,
                'complaint_id' => $record->id,
                // 'recieved_user_id' => $user->id,
                'sent_user_id' => $user->id,
                'recieved_date' => now(),
                'sent_date' => now(),
                'desc' => 'Хүлээн авсан',
                'status_id' => 2

            ]);

            return response()->json(['message' => 'Record updated successfully', 'record' => $record, 'complaint_step' => $complaint_step]);
        }
        if ($record->second_status_id == 0 && $record->second_org_id == Auth::user()->org_id) {
            $record->update([
                'second_status_id' => 2,
                'second_user_id' => $user->id,
            ]);
            $complaint_step = ComplaintStep::create([
                'org_id' => $user->org_id,
                'complaint_id' => $record->id,
                // 'recieved_user_id' => $user->id,
                'sent_user_id' => $user->id,
                'recieved_date' => now(),
                'sent_date' => now(),
                'desc' => 'Хүлээн авсан',
                'status_id' => 2

            ]);

            return response()->json(['message' => 'Record updated successfully', 'record' => $record, 'complaint_step' => $complaint_step]);
        }

        return response()->json(['message' => 'Record not updated']);
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
