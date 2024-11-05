<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Cdr;
use App\Models\File;
use App\Models\Soum;
use App\Models\User;
use App\Models\Aimag;
use App\Models\Rating;
use App\Models\Status;
use App\Models\Channel;
use App\Models\DanUser;
use App\Models\Category;
use App\Mail\WelcomeMail;
use App\Models\Complaint;
use App\Jobs\SendEmailJob;
use App\Models\EnergyType;
use App\Models\Organization;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\ComplaintStep;
use App\Models\ComplaintType;
use App\Models\SourceComplaint;
use App\Exports\ExportComplaint;
use App\Models\ComplaintMakerType;
use Illuminate\Support\Facades\DB;
use App\Mail\ComplaintNotification;
use App\Models\OrganizationNumbers;
use Illuminate\Support\Facades\Log;
use App\Models\ComplaintTypeSummary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
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

        // $user_district = $danUser->danSoumDistrictName;
        // $user_khoroo_number = intval(str_replace(['-р хороо'], '', $danUser->danBagKhorooName));

        // $orgs = Organization::whereHas('serviceAreas', function ($query) use ($user_district, $user_khoroo_number) {
        //     $query->where('district', 'LIKE', '%' . $user_district . '%')
        //         ->where('khoroo', 'LIKE', '%' . $user_khoroo_number . '%');
        // })->get();

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
        $danUser = Auth::user();
        $energy_type_id = $request->input('energy_type_id');

        // $user_district = $danUser->danSoumDistrictName;
        // $user_khoroo_number = intval(str_replace(['-р хороо'], '', $danUser->danBagKhorooName));

        // if ($energy_type_id == 1) {
        //     $data['orgs'] = Organization::where("plant_id", $energy_type_id)
        //         ->whereNotIn("id", [99])
        //         ->orderBy("name")
        //         ->get(["name", "id"]);
        // } else {

        //     $data['orgs'] = Organization::whereHas('serviceAreas', function ($query) use ($user_district, $user_khoroo_number) {
        //         $query->where('district', 'LIKE', '%' . $user_district . '%')
        //             ->where('khoroo', 'LIKE', '%' . $user_khoroo_number . '%');
        //     })->where("plant_id", $energy_type_id)
        //         ->whereNotIn("id", [99])
        //         ->orderBy("name")
        //         ->get(["name", "id"]);
        // }


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

        $fileName = null;
        $fileUrl = null;
        $fileExt = null;
        $fileSizeInKilobytes = null;

        if ($complaint->file_id != null) {
            $fileName = $complaint->file?->filename; // Example dynamic image URL
            $fileUrl = 'files/' . $complaint->file?->filename; // Example dynamic image URL
            $fileExt = pathinfo($complaint->file?->filename, PATHINFO_EXTENSION);
            $fileSizeInBytes = filesize(public_path($fileUrl));
            $fileSizeInKilobytes = round($fileSizeInBytes / 1024); // Convert Kbytes to megabytes
        }

        $complaint_steps = ModelsComplaintStep::where('complaint_id', $id)->get();

        // dd($complaint_steps);
        return view('complaints.showComplaint', compact('complaint', 'complaint_steps', 'fileName', 'fileUrl', 'fileExt', 'fileSizeInKilobytes'));
    }

    public function index(Request $request)
    {
        // dd($request);
        $daterange = $request->query('daterange');
        $search_text = $request->query('search_text');
        $serial_number = $request->query('serial_number');
        $status_id = $request->query('status_id');
        $org_id = $request->query('org_id');
        $second_org_id = $request->query('second_org_id');
        $energy_type_id = $request->query('energy_type_id');
        $controlled_user_id = $request->query('controlled_user_id');
        $channel_id = $request->query('channel_id');

        $user_code = $request->query('user_code');
        $phone = $request->query('phone');
        $expire_status = $request->query('expire_status');

        $complaint_type_id = $request->query('complaint_type_id');
        $complaint_type_summary_id = $request->query('complaint_type_summary_id');

        // Retrieve the related complaint IDs from the query parameters
        $relatedComplaintIds = $request->query('related_complaints', []);

        $query = Complaint::query();
        // $query->with('complaintSteps');
        $query->orderBy('complaint_date', 'desc');

        // Fetch complaints based on the provided IDs
        if ($relatedComplaintIds !== null && !empty($relatedComplaintIds)) {
            $query->whereIn('id', $relatedComplaintIds);
        }

        if (isset($daterange)) {
            $dates = explode(' to ', $daterange);
            $start_date = $dates[0];
            $end_date = $dates[1];
            // $query->whereBetween('complaint_date', [$start_date, $end_date]);
            $query->whereBetween('complaint_date', [
                \Carbon\Carbon::parse($dates[0])->startOfDay(),
                \Carbon\Carbon::parse($dates[1])->endOfDay()
            ]);
        }

        if ($serial_number !== null) {
            $query->where('serial_number', $serial_number);
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
        if ($second_org_id !== null) {
            $query->where('second_org_id', $second_org_id);
        }

        if ($controlled_user_id !== null) {
            $query->where('controlled_user_id', $controlled_user_id);
        }

        if ($channel_id !== null) {
            $query->where('channel_id', $channel_id);
        }

        if ($phone !== null) {
            $query->where('phone', $phone);
        }
        if ($user_code !== null) {
            $userdata = Registration::where('code', $user_code)->first();
            // dd($userdata->phoneNumber);
            $query->where('phone', $userdata->phoneNumber);
        }

        // Filter by expired status
        if ($expire_status === 'expired') {
            $query->where('expire_date', '<', now())->where('status_id', '!=', 6);
        } elseif ($expire_status === 'not_expired') {
            $query->where('expire_date', '>', now());
        }

        // Нэвтэрсэн хэрэглэгч ЭХЗХ биш ТЗЭ бол зөвхөн тухайн байгууллагын мэдээллийг харуулна
        $logged_user_org_id = Auth::user()->org_id;
        if ($logged_user_org_id != 99) {
            $query->where('organization_id', $logged_user_org_id);
        }

        if ($energy_type_id !== null) {
            $query->where('energy_type_id', $energy_type_id);
        }

        if ($complaint_type_id !== null) {
            $query->where('complaint_type_id', $complaint_type_id);
        }
        if ($complaint_type_summary_id !== null) {
            $query->where('complaint_type_summary_id', $complaint_type_summary_id);
        }

        $complaints = $query->paginate(15);

        $statuses = Status::all();
        $orgs = Organization::orderBy('name', 'asc')->get();
        $energy_types = EnergyType::all();
        $channels = Channel::all();
        $controlled_users = User::where('org_id', Auth::user()->org_id)->orderBy('name', 'asc')->get();
        $complaint_types = ComplaintType::all();
        $complaint_type_summaries = ComplaintTypeSummary::all();

        return view('complaints.index', compact('complaints', 'daterange', 'search_text', 'statuses', 'status_id', 'org_id', 'orgs', 'energy_type_id', 'energy_types', 'channel_id', 'channels', 'controlled_user_id', 'controlled_users', 'second_org_id', 'phone', 'user_code', 'expire_status', 'complaint_types', 'complaint_type_id', 'complaint_type_summaries', 'complaint_type_summary_id', 'relatedComplaintIds', 'serial_number'));
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
        $selected_year = $request->query('year');
        $serial_number = $request->query('serial_number');

        $query = Complaint::query();

        if (!empty($selected_year)) {
            $query->whereYear('complaint_date', $selected_year);
        } else {
            $currentYear = now()->year;
            $query->whereYear('complaint_date', $currentYear);
        }

        if (!empty($search_text)) {
            $query->where('complaint', 'LIKE', '%' . $search_text . '%');
        }
        if (!empty($serial_number)) {
            $query->where('serial_number', 'LIKE', '%' . $serial_number . '%');
        }

        if (!empty($daterange)) {
            $dates = explode(' to ', $daterange);
            $start_date = $dates[0];
            $end_date = $dates[1];

            $query->whereBetween('complaint_date', [$start_date, $end_date]);
        }

        switch ($status_id) {
            case '0':
                // Шинээр ирсэн эсвэл шинээр шилжиж ирсэн
                if (Auth::user()->org_id == 99) {
                    $query->where('status_id', 0)->where('organization_id', $org_id);
                } else {
                    $query->where(function ($query) {
                        $query->where('status_id', 0)
                            ->orWhere('second_status_id', 0);
                    })->where(function ($query) {
                        $query->where('organization_id', Auth::user()->org_id)
                            ->orWhere('second_org_id', Auth::user()->org_id);
                    });
                }
                break;
            case '1':
                // Шинээр шилжиж ирсэн
                $query->where('organization_id', $org_id)->where('status_id', 1)->where('controlled_user_id', Auth::user()->id);
                break;
            case '2':
                // Хүлээн авсан
                if (Auth::user()->org_id == 99) {
                    $query->where('status_id', 2)->where('organization_id', $org_id)->where('controlled_user_id', Auth::user()->id);
                } else {
                    $query->where(function ($query) {
                        $query->where('status_id', 2)
                            ->orWhere('second_status_id', 2);
                    })->where(function ($query) {
                        $query->where('organization_id', Auth::user()->org_id)
                            ->orWhere('second_org_id', Auth::user()->org_id);
                    })->where(function ($query) {
                        $query->where('controlled_user_id', Auth::user()->id)
                            ->orWhere('second_user_id', Auth::user()->id);
                    });
                }
                break;
            case '3':
                // Хянаж байгаа
                if (Auth::user()->org_id == 99) {
                    $query->where('status_id', 3)->where('organization_id', $org_id)->where('controlled_user_id', Auth::user()->id);
                } else {
                    $query->where(function ($query) {
                        $query->where('status_id', 3)
                            ->orWhere('second_status_id', 3);
                    })->where(function ($query) {
                        $query->where('organization_id', Auth::user()->org_id)
                            ->orWhere('second_org_id', Auth::user()->org_id);
                    })->where(function ($query) {
                        $query->where('controlled_user_id', Auth::user()->id)
                            ->orWhere('second_user_id', Auth::user()->id);
                    });
                }
                break;
            case '4':
                // Цуцалсан
                $query->where('status_id', 4)->where('organization_id', $org_id)->where('controlled_user_id', Auth::user()->id);
                break;
            case '6':
                // Шийдвэрлэсэн
                if (Auth::user()->org_id == 99) {
                    $query->where('status_id', 6)->where('organization_id', $org_id)->where('controlled_user_id', Auth::user()->id);
                } else {
                    $query->where(function ($query) {
                        $query->where('status_id', 6)
                            ->orWhere('second_status_id', 6);
                    })->where(function ($query) {
                        $query->where('organization_id', Auth::user()->org_id)
                            ->orWhere('second_org_id', Auth::user()->org_id);
                    })->where(function ($query) {
                        $query->where('controlled_user_id', Auth::user()->id)
                            ->orWhere('second_user_id', Auth::user()->id);
                    });
                }
                break;

            default:
                // Handle the default case or show an error
                break;
        }

        $complaints = $query->orderBy('complaints.created_at', 'desc')->paginate(10);

        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 5, -1);

        return view('complaints.indexDetail', compact('complaints', 'serial_number', 'selected_year', 'daterange', 'search_text', 'status_id', 'years'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $org_id = Auth::user()->org_id;

        $categories = Category::orderBy('name', 'asc')->get();
        $orgs = Organization::orderBy('name', 'asc')->get();
        $channels = Channel::all();
        $complaint_types = ComplaintType::all();
        $energy_types = EnergyType::all();
        $complaint_type_summaries = ComplaintTypeSummary::all();
        $complaint_maker_types = ComplaintMakerType::all();

        // Fetch the last 10 phone audio calls from the database
        $org_numbers = OrganizationNumbers::where('organization_id', $org_id)->pluck('phone_number')->toArray();
        $audio_calls = Cdr::whereIn('dst', $org_numbers)->where('disposition', 'ANSWERED')->orderBy('calldate', 'desc')->latest()->take(10)->get();

        return view('complaints.create', compact('categories', 'orgs', 'channels', 'complaint_types', 'energy_types', 'complaint_type_summaries', 'complaint_maker_types', 'audio_calls'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplaintStoreRequest $request)
    {
        $input = $request->all();
        // dd($input);

        $user = Auth::user();

        if ($audio_file = $request->file('audio_file')) {
            $name = time() . $audio_file->getClientOriginalName();

            $audio_file->move('files', $name);
            $filename = File::create(['filename' => $name]);

            $input['audio_file_id'] = $filename->id;
        }

        $input['created_user_id'] = $user->id;

        // Хэрэв Иргэн ААН гомдол гаргавал шинээр ирсэн төлөвтэй байна
        // ЭХЗХ эсвал ТЗЭ нар бүртгэсэн тохиолдолд хүлээн авсан төлөвтэй байна
        if ($user->org_id != null) {
            $input['controlled_user_id'] = $user->id;
            $input['status_id'] = 2; // Хүлээн авсан төлөвт орно
        } else {
            // Хэрэглэгчийн мэдээлэл хадгалах
            if ($user->companyName) {
                $input['complaint_maker_org_name'] = $user->companyName;
                $input['registerNumber'] = $user->companyRegnum;
                $input['complaint_maker_type_id'] = 2; // ААН
            } else {
                $input['registerNumber'] = $user->danRegnum ? $user->danRegnum : '';
                $input['complaint_maker_type_id'] = 1; // Иргэн
            }

            $input['lastname'] = $user->danLastname ? $user->danLastname : '';
            $input['firstname'] = $user->danFirstname ? $user->danFirstname : '';
            $input['country'] = $user->danAimagCityName ? $user->danAimagCityName : '';
            $input['district'] = $user->danSoumDistrictName ? $user->danSoumDistrictName : '';
            $input['khoroo'] = $user->danBagKhorooName ? $user->danBagKhorooName : '';

            // Өргөдлийн мэдээлэл хадгалах
            $input['status_id'] = 0; // Шинээр ирсэн төлөвт орно
        }
        // Бүртгэсэн хугацаа
        if (empty($input['complaint_date'])) {
            $input['complaint_date'] = now();
        }

        // Хэрэв Иргэн ААН гомдол гаргавал суваг нь Веб байна
        if (empty($input['channel_id'])) {
            $input['channel_id'] = 1;
        }

        // ЭХЗХ эсвал ТЗЭ нар гомдол бүртгэхэд тухайн байгууллагын нэрээр бүртгэгдэнэ
        if (empty($input['organization_id'])) {
            $input['organization_id'] = $user->org_id;
        }

        $complaint = new Complaint($input);

        // Дуусах хугацаа
        if (empty($input['expire_date'])) {
            $complaint->setExpireDate($input['complaint_type_id'], $input['channel_id'], $input['category_id']);
        }



        //$complaint = Complaint::create($input);
        $complaint->save();


        // file upload
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();

                // Move each file and store in 'files' directory
                $file->move(public_path('files'), $name);

                // Save file record with associated complaint_id
                File::create([
                    'filename' => $name,
                    'complaint_id' => $complaint->id,
                ]);
            }
        }

        // Create complaint step about received
        if ($complaint->status_id == 2) {
            ComplaintStep::create([
                'org_id' => $user->org_id,
                'complaint_id' => $complaint->id,
                // 'recieved_user_id' => $user->id,
                'sent_user_id' => $user->id,
                'recieved_date' => now(),
                'sent_date' => now(),
                'desc' => 'Хүлээн авсан',
                'status_id' => 2
            ]);
            // Send email about complaint recieved
            if ($complaint->email != null) {
                SendEmailJob::dispatch($complaint);
            }
        }

        // channel_id = 7 байвал 1111 төвийн гомдол
        // $source_number = $input['source_number'];
        if ($complaint->channel_id == 7 && $complaint->source_number != null) {

            $sourceComplaint = SourceComplaint::where('number', $complaint->source_number)->first();

            if ($sourceComplaint) {
                // Update the record
                $sourceComplaint->complaint_id = $complaint->id;
                $sourceComplaint->save();

                // 1111 төвийн гомдлыг хүлээн авсан төлөвт шилжүүлэх
                $params = [
                    'action' => 'do-receipt',
                    'number' => $complaint->source_number,
                    'u' => env('1111_API_USERNAME'),
                    'p' => env('1111_API_PASSWORD'),
                    'api_key' => '-'
                ];
                $response = Http::get('https://www.11-11.mn/GStest/APIa', $params);
                $result = $response->json();

                if ($result['isValid'] && $result['smart']['isValid']) {
                    // API request success
                    Log::channel('1111_log')->info('do-reciept action successfully. 1111 ээс ирсэн гомдлыг амжилттэй хүлээн авлаа. UserId: ' . Auth::user()->id . ' complaint_serial_number: ' . $complaint->serial_number);
                } else {
                    // API request failed
                    Log::channel('1111_log')->error('Failed do-reciept action. 1111 ээс ирсэн гомдлыг хүлээн авахад алдаа гарлаа.');
                }
            }
        }
        // Send email
        // Mail::to($user->email)->send(new ComplaintNotification($user, $complaint));

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

        $fileName = null;
        $fileUrl = null;
        $fileExt = null;
        $fileSizeInKilobytes = null;

        if ($complaint->file_id != null) {
            $fileName = $complaint->file?->filename;
            $fileUrl = 'files/' . $complaint->file?->filename; // Example dynamic image URL
            $fileExt = pathinfo($complaint->file?->filename, PATHINFO_EXTENSION);
            $fileSizeInBytes = filesize(public_path($fileUrl));
            $fileSizeInKilobytes = round($fileSizeInBytes / 1024); // Convert Kbytes to megabytes
        }


        $rating = Rating::where('user_id', auth()->user()->id)->where('complaint_id', $id)->first();
        // dd($rating);

        $related_complaints = Complaint::where('phone', $complaint->phone)->where('firstname', $complaint->firstname)->get();

        return view('complaints.show', compact('complaint', 'rating', 'fileName', 'fileUrl', 'fileExt', 'fileSizeInKilobytes', 'related_complaints'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $org_id = Auth::user()->org_id;

        $complaint = Complaint::findOrFail($id);
        $categories = Category::all();
        $orgs = Organization::all();
        $channels = Channel::all();
        $complaint_types = ComplaintType::all();
        $energy_types = EnergyType::all();
        $complaint_type_summaries = ComplaintTypeSummary::all();
        $complaint_maker_types = ComplaintMakerType::all();

        // Fetch the last 10 phone audio calls from the database
        $org_numbers = OrganizationNumbers::where('organization_id', $org_id)->pluck('phone_number')->toArray();
        $audio_calls = Cdr::whereIn('dst', $org_numbers)->orderBy('calldate', 'desc')->latest()->take(10)->get();

        return view('complaints.edit', compact('complaint', 'categories', 'orgs', 'channels', 'complaint_types', 'energy_types', 'complaint_type_summaries', 'complaint_maker_types', 'audio_calls'));
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

        // if ($request->second_org_id != null) {
        //     $input['status_id'] = 1;
        //     $input['second_status_id'] = 0;
        // }


        // $input['status_id'] = 0;
        $input['updated_user_id'] = $user->id;

        // dd($input);

        $complaint->update($input);

        return redirect()->route('complaint.create')->with('success', 'Амжилттай хадгаллаа.');
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

        // return redirect()->route('complaint.index')->with('success', 'Амжилттай устгалаа.');
        return redirect()->route('complaint.create')->with('success', 'Амжилттай устгалаа.');
    }
}