<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\File;
use App\Models\User;
use App\Models\Status;
use Livewire\Component;
use App\Models\Complaint;
use App\Jobs\SendEmailJob;
use App\Models\Organization;
use App\Jobs\SendTzeEmailJob;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use App\Models\ComplaintStep as ModelsComplaintStep;
use App\Helpers\ComplaintHelper;

class ComplaintStep extends Component
{
    use WithFileUploads;

    public $complaint_steps, $org_id, $status_id, $complaint_id, $recieved_user_id, $sent_user_id, $recieved_date, $sent_date, $desc, $orgs, $all_status, $actions, $selectedAction, $controlled_user_id, $employees, $selected_user_id, $second_user_id, $file, $step_id, $expire_date, $is_expired, $complaint_type_id, $complaint_type_summary_id, $amount, $selected_date, $complaint_step;
    public $isOpen = 0;
    public $showPermissionWarning = false;
    public $isEditMode = false;
    public $files = [];


    public function mount($complaint)
    {
        // dd($complaint);
        $this->complaint_id = $complaint->id;
        $this->org_id = $complaint->organization_id;
        $this->controlled_user_id = $complaint->controlled_user_id;
        $this->second_user_id = $complaint->second_user_id;
        $this->expire_date = $complaint->expire_date;
        $this->status_id = $complaint->status_id;
        $this->is_expired = $complaint->hasExpired();
        $this->complaint_type_id = $complaint->complaint_type_id;
        $this->complaint_type_summary_id = $complaint->complaint_type_summary_id;
        $this->orgs = Organization::orderBy('name', 'asc')->get();
        $this->all_status = Status::all();

        if (Auth::user()->role->name == "admin" || Auth::user()->role->name == "ehzh") {

            // Use a switch case to set actions based on both status_id and organization_id
            switch ($this->status_id) {
                case 2: // Хүлээн авсан
                    $this->actions = ['Тайлбар', 'Шилжүүлэх', 'Цуцлах', 'Хянаж байгаа', 'Шийдвэрлэх', 'Сунгах', 'ТЗЭ-рүү шилжүүлэх'];
                    break;
                case 3: // Хянаж байгаа
                    $this->actions = ['Тайлбар', 'Шилжүүлэх', 'Цуцлах', 'Шийдвэрлэх', 'Сунгах', 'ТЗЭ-рүү шилжүүлэх'];
                    break;
                case 6: // Шийдвэрлэсэн
                    $this->actions = ['Тайлбар'];
                    break;
                default: // Тайлбар
                    $this->actions = ['Тайлбар', 'Шилжүүлэх', 'Цуцлах', 'Шийдвэрлэх', 'Сунгах', 'ТЗЭ-рүү шилжүүлэх'];
            }
        } else {
            switch ($this->status_id) {
                case 2: // Хүлээн авсан
                    $this->actions = ['Тайлбар', 'Шилжүүлэх', 'Цуцлах', 'Хянаж байгаа', 'Шийдвэрлэх'];
                    break;
                case 3: // Хянаж байгаа
                    $this->actions = ['Тайлбар', 'Шилжүүлэх', 'Цуцлах', 'Шийдвэрлэх'];
                    break;
                case 6: // Шийдвэрлэсэн
                    $this->actions = ['Тайлбар'];
                    break;
                default: // Тайлбар
                    $this->actions = ['Тайлбар', 'Шилжүүлэх', 'Цуцлах', 'Шийдвэрлэх'];
            }
        }
        $this->employees = User::where('org_id', $this->org_id)->where('id', '!=', Auth::user()->id)->orderBy('name', 'asc')->get();

        // $this->complaint_steps = ModelsComplaintStep::where('complaint_id', $this->complaint_id)->get();
    }

    public function render()
    {
        $this->complaint_steps = ModelsComplaintStep::where('complaint_id', $this->complaint_id)->with('complaint')->orderBy('created_at', 'asc')->get();

        return view('livewire.complaint-step');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isEditMode = false; // Set to create mode
        $this->openModal();
    }

    public function openModal()
    {
        // $this->isOpen = true;
        // Check user permissions before opening the modal
        if (Auth::user()->role->name == "admin" || Auth::user()->role?->name == 'ehzh') {
            $this->isOpen = true;
            $this->showPermissionWarning = false;
        } else {
            if ($this->status_id == 6) {
                $this->showPermissionWarning = true;
                session()->flash('info', 'Шийдвэрлэгдсэн төлөвтэй өргөдөл, гомдлыг удирдах боломжгүй!');
            } elseif ($this->status_id == 4) {
                $this->showPermissionWarning = true;
                session()->flash('warning', 'Цуцлагдсан төлөвтэй өргөдөл, гомдлыг удирдах боломжгүй!');
            } elseif ($this->is_expired) {
                $this->showPermissionWarning = true;
                session()->flash('warning', 'Өргөдөл, гомдол шийдвэрлэх хугацаа дууссан байна!');
            } elseif ($this->controlled_user_id !== Auth::user()->id && $this->second_user_id !== Auth::user()->id) {
                $this->showPermissionWarning = true;
                session()->flash('warning', 'Таны хариуцсан өргөдөл, гомдол биш байна!');
            } else {
                $this->isOpen = true;
                $this->showPermissionWarning = false;
            }
        }
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->desc = '';
        $this->files = null;
    }

    public function download($path)
    {
        $file = public_path('files/' . $path); // Path to the file to download
        return Response::download($file);
    }

    public function store()
    {
        $this->validate([
            'desc' => 'required',
            'files.*' => 'nullable|mimes:jpeg,png,jpg,pdf|max:20480', // 20MB Max
        ]);

        $complaint = Complaint::findOrFail($this->complaint_id);
        $action = $this->selectedAction;
        $stepData = [
            'complaint_id' => $this->complaint_id,
            'sent_user_id' => Auth::user()->id,
            'desc' => $this->desc,
            'action_taken' => $action,
            'sent_date' => Carbon::now()->toDateTimeString(),
            'amount' => $this->amount,
        ];

        switch ($this->selectedAction) {
            case 'Тайлбар':
                // Тайлбар бичихэд төлөв өөрчлөгдөхгүй
                $stepData['status_id'] = 8;
                $stepData['org_id'] = $complaint->second_org_id ?? $complaint->organization_id;

                //Хэрвээ 1111-ээс ирсэн гомдол байвал 1111 рүү мэдээлэл дамжуулах
                ComplaintHelper::send1111API($complaint, false, $this->desc);
                // if ($complaint->channel_id == 7 && $complaint->source_number != null) {
                //     $params = [
                //         'action' => 'create-log',
                //         'u' => env('1111_API_USERNAME'),
                //         'p' => env('1111_API_PASSWORD'),
                //         'api_key' => '-',
                //         'number' => $complaint->source_number,
                //         'is_close' => 'false',
                //         'created_by' => Auth::user()->name,
                //         'comment' => $this->desc,
                //     ];
                //     $response = Http::get('https://www.11-11.mn/GStest/APIa', $params);
                //     $result = $response->json();

                //     if ($result['isValid'] && $result['smart']['isValid']) {
                //         // 1111 API request success
                //         Log::channel('1111_log')->info('1111 рүү тайлбар амжилттай илгээлээ. user_id: ' . Auth::user()->id . ' complaint_serial_number: ' . $complaint->serial_number);
                //     } else {
                //         // 1111 API request failed
                //         Log::channel('1111_log')->error('Failed create-log action.');
                //     }
                // }

                break;
            case 'Шилжүүлэх':
                // Байгууллага дотроо өөр хүнд шилжүүлэхэд төлөв тухайн хүн хүлээн авсан болно

                $complaint->update(['status_id' => 2, 'controlled_user_id' => $this->selected_user_id]);
                $stepData['status_id'] = 1;
                $stepData['org_id'] = $this->org_id;

                // Хэрвээ 1111-ээс ирсэн гомдол байвал 1111 рүү мэдээлэл дамжуулах
                $comment = 'Мэргэжилтэн ' . $complaint->controlledUser?->name . ' рүү шилжүүлэв. Тайлбар: ' . $this->desc;
                ComplaintHelper::send1111API($complaint, false, $comment);
                // if ($complaint->channel_id == 7 && $complaint->source_number != null) {
                //     $params = [
                //         'action' => 'create-log',
                //         'u' => env('1111_API_USERNAME'),
                //         'p' => env('1111_API_PASSWORD'),
                //         'api_key' => '-',
                //         'number' => $complaint->source_number,
                //         'is_close' => 'false',
                //         'created_by' => Auth::user()->name,
                //         'comment' => 'Мэргэжилтэн ' . $complaint->controlledUser?->name . 'рүү шилжүүлэв. Тайлбар: ' . $this->desc,
                //     ];
                //     $response = Http::get('https://www.11-11.mn/GStest/APIa', $params);
                //     $result = $response->json();

                //     if ($result['isValid'] && $result['smart']['isValid']) {
                //         // 1111 API request success
                //         Log::channel('1111_log')->info('1111 рүү байгууллага доторх шилжүүлгийн мэдээлэл амжилттай илгээлээ. user_id: ' . Auth::user()->id . ' complaint_serial_number: ' . $complaint->serial_number);
                //     } else {
                //         // 1111 API request failed
                //         Log::channel('1111_log')->error('Failed create-log action.');
                //     }
                // }

                break;
            case 'ТЗЭ-рүү шилжүүлэх':
                // ТЗЭ рүү шилжүүлэхэд төлөв хянаж байгаа төлөвтэй болно
                $complaint->update(['status_id' => 1, 'second_org_id' => $this->org_id, 'second_status_id' => 0]);
                $stepData['status_id'] = 1;
                $stepData['org_id'] = $complaint->organization_id;

                // Хүлээн авч буй ТЗЭ байгууллагын хэрэглэгчид мэйлээр мэдэгдэх
                $recvUser = User::where('org_id', $this->org_id)->first();
                // Send email about new complaint recieved
                if ($recvUser != null) {
                    SendTzeEmailJob::dispatch($complaint, $recvUser);
                }

                // Хэрвээ 1111-ээс ирсэн гомдол байвал 1111 рүү мэдээлэл дамжуулах
                $comment = $complaint->secondOrg?->name . ' рүү шилжүүлэв. Тайлбар: ' . $this->desc;
                ComplaintHelper::send1111API($complaint, false, $comment);
                // if ($complaint->channel_id == 7 && $complaint->source_number != null) {
                //     $params = [
                //         'action' => 'create-log',
                //         'u' => env('1111_API_USERNAME'),
                //         'p' => env('1111_API_PASSWORD'),
                //         'api_key' => '-',
                //         'number' => $complaint->source_number,
                //         'is_close' => 'false',
                //         'created_by' => Auth::user()->name,
                //         'comment' => $complaint->secondOrg?->name . ' рүү шилжүүлэв. Тайлбар: ' . $this->desc,
                //     ];
                //     $response = Http::get('https://www.11-11.mn/GStest/APIa', $params);
                //     $result = $response->json();

                //     if ($result['isValid'] && $result['smart']['isValid']) {
                //         // 1111 API request success
                //         Log::channel('1111_log')->info('1111 рүү ТЗЭ-ийн шилжүүлгийн мэдээлэл амжилттай илгээлээ. user_id: ' . Auth::user()->id . ' complaint_serial_number: ' . $complaint->serial_number);
                //     } else {
                //         // 1111 API request failed
                //         Log::channel('1111_log')->error('Failed create-log action.');
                //     }
                // }

                break;
            case 'Хянаж байгаа':
                // Төлөв хянаж байгаа болно
                $complaint->update([
                    $complaint->second_org_id ? 'second_status_id' : 'status_id' => 3
                ]);

                $stepData['status_id'] = 3;
                $stepData['org_id'] = $complaint->second_org_id ?? $complaint->organization_id;

                // Send email about complaint recieved
                if ($complaint->email != null) {
                    SendEmailJob::dispatch($complaint);
                }

                // Хэрвээ 1111-ээс ирсэн гомдол байвал 1111 рүү мэдээлэл дамжуулах
                ComplaintHelper::send1111API($complaint, false, $this->desc);
                // if ($complaint->channel_id == 7 && $complaint->source_number != null) {
                //     $params = [
                //         'action' => 'create-log',
                //         'u' => env('1111_API_USERNAME'),
                //         'p' => env('1111_API_PASSWORD'),
                //         'api_key' => '-',
                //         'number' => $complaint->source_number,
                //         'is_close' => 'false',
                //         'created_by' => Auth::user()->name,
                //         'comment' => $this->desc,
                //     ];
                //     $response = Http::get('https://www.11-11.mn/GStest/APIa', $params);
                //     $result = $response->json();

                //     if ($result['isValid'] && $result['smart']['isValid']) {
                //         // 1111 API request success
                //         Log::channel('1111_log')->info('1111 рүү Хянаж байгаа мэдээлэл амжилттай илгээлээ. user_id: ' . Auth::user()->id . ' complaint_serial_number: ' . $complaint->serial_number);
                //     } else {
                //         // 1111 API request failed
                //         Log::channel('1111_log')->error('Failed create-log action.');
                //     }
                // }

                break;
            case 'Цуцлах':
                // Төлөв цуцалсан болно
                $complaint->update(['status_id' => 4]);
                $stepData['status_id'] = 4;
                $stepData['org_id'] = $this->org_id;

                // Send email about complaint recieved
                if ($complaint->email != null) {
                    SendEmailJob::dispatch($complaint);
                }

                // Хэрвээ 1111-ээс ирсэн гомдол байвал 1111 рүү мэдээлэл дамжуулах
                ComplaintHelper::send1111API($complaint, false, $this->desc);
                // if ($complaint->channel_id == 7 && $complaint->source_number != null) {
                //     $params = [
                //         'action' => 'create-log',
                //         'u' => env('1111_API_USERNAME'),
                //         'p' => env('1111_API_PASSWORD'),
                //         'api_key' => '-',
                //         'number' => $complaint->source_number,
                //         'is_close' => 'false',
                //         'created_by' => Auth::user()->name,
                //         'comment' => $this->desc,
                //     ];
                //     $response = Http::get('https://www.11-11.mn/GStest/APIa', $params);
                //     $result = $response->json();

                //     if ($result['isValid'] && $result['smart']['isValid']) {
                //         // 1111 API request success
                //         Log::channel('1111_log')->info('1111 рүү Цуцалсан мэдээлэл амжилттай илгээлээ. user_id: ' . Auth::user()->id . ' complaint_serial_number: ' . $complaint->serial_number);
                //     } else {
                //         // 1111 API request failed
                //         Log::channel('1111_log')->error('Failed create-log action.');
                //     }
                // }

                break;
            case 'Шийдвэрлэх':
                // Төлөв шийдвэрлэсэн болно
                if ($complaint->second_org_id == null) {
                    $complaint->status_id = 6;
                    $stepData['org_id'] = $this->org_id;

                    // Send email about complaint recieved
                    if ($complaint->email != null) {
                        SendEmailJob::dispatch($complaint);
                    }

                    // Хэрвээ 1111-ээс ирсэн гомдол байвал 1111 рүү мэдээлэл дамжуулах
                    $isClose = true;
                    ComplaintHelper::send1111API($complaint, $isClose, $this->desc);
                    // if ($complaint->channel_id == 7 && $complaint->source_number != null) {
                    //     $params = [
                    //         'action' => 'create-log',
                    //         'u' => env('1111_API_USERNAME'),
                    //         'p' => env('1111_API_PASSWORD'),
                    //         'api_key' => '-',
                    //         'number' => $complaint->source_number,
                    //         'is_close' => 'true',
                    //         'created_by' => Auth::user()->name,
                    //         'comment' => $this->desc,
                    //     ];
                    //     $response = Http::get('https://www.11-11.mn/GStest/APIa', $params);
                    //     $result = $response->json();

                    //     if ($result['isValid'] && $result['smart']['isValid']) {
                    //         // 1111 API request success
                    //         Log::channel('1111_log')->info('1111 рүү Шийдвэрлэсэн мэдээлэл амжилттай илгээлээ. user_id: ' . Auth::user()->id . ' complaint_serial_number: ' . $complaint->serial_number);
                    //     } else {
                    //         // 1111 API request failed
                    //         Log::channel('1111_log')->error('Failed create-log action.');
                    //     }
                    // }
                } else {
                    if (Auth::user()->org_id == 99) {
                        $complaint->status_id = 6;
                        $complaint->second_status_id = 6;
                        $stepData['org_id'] = $complaint->organization_id;

                        // Send email about complaint recieved
                        if ($complaint->email != null) {
                            SendEmailJob::dispatch($complaint);
                        }

                        // Хэрвээ 1111-ээс ирсэн гомдол байвал 1111 рүү мэдээлэл дамжуулах
                        $isClose = true;
                        ComplaintHelper::send1111API($complaint, $isClose, $this->desc);
                        // if ($complaint->channel_id == 7 && $complaint->source_number != null) {
                        //     $params = [
                        //         'action' => 'create-log',
                        //         'u' => env('1111_API_USERNAME'),
                        //         'p' => env('1111_API_PASSWORD'),
                        //         'api_key' => '-',
                        //         'number' => $complaint->source_number,
                        //         'is_close' => 'true',
                        //         'created_by' => Auth::user()->name,
                        //         'comment' => $this->desc,
                        //     ];
                        //     $response = Http::get('https://www.11-11.mn/GStest/APIa', $params);
                        //     $result = $response->json();

                        //     if ($result['isValid'] && $result['smart']['isValid']) {
                        //         // 1111 API request success
                        //         Log::channel('1111_log')->info('1111 рүү Шийдвэрлэсэн мэдээлэл амжилттай илгээлээ. user_id: ' . Auth::user()->id . ' complaint_serial_number: ' . $complaint->serial_number);
                        //     } else {
                        //         // 1111 API request failed
                        //         Log::channel('1111_log')->error('Failed create-log action.');
                        //     }
                        // }
                    } else {
                        $complaint->second_status_id = 6;
                        $stepData['org_id'] = $complaint->second_org_id;

                        // Send email about complaint recieved
                        if ($complaint->email != null) {
                            SendEmailJob::dispatch($complaint);
                        }

                        // Хэрвээ 1111-ээс ирсэн гомдол байвал 1111 рүү мэдээлэл дамжуулах
                        ComplaintHelper::send1111API($complaint, false, $this->desc);
                        // if ($complaint->channel_id == 7 && $complaint->source_number != null) {
                        //     $params = [
                        //         'action' => 'create-log',
                        //         'u' => env('1111_API_USERNAME'),
                        //         'p' => env('1111_API_PASSWORD'),
                        //         'api_key' => '-',
                        //         'number' => $complaint->source_number,
                        //         'is_close' => 'false',
                        //         'created_by' => Auth::user()->name,
                        //         'comment' => $this->desc,
                        //     ];
                        //     $response = Http::get('https://www.11-11.mn/GStest/APIa', $params);
                        //     $result = $response->json();

                        //     if ($result['isValid'] && $result['smart']['isValid']) {
                        //         // 1111 API request success
                        //         Log::channel('1111_log')->info('1111 рүү Шийдвэрлэсэн мэдээлэл амжилттай илгээлээ. user_id: ' . Auth::user()->id . ' complaint_serial_number: ' . $complaint->serial_number);
                        //     } else {
                        //         // 1111 API request failed
                        //         Log::channel('1111_log')->error('Failed create-log action.');
                        //     }
                        // }
                    }
                }

                $complaint->save();
                $stepData['status_id'] = 6;

                break;
            case 'Сунгах':
                // Шийдвэрлэх хугацааг 48 цагаар сунгах, төлөв өөрчлөгдөхгүй
                $complaint->update(['expire_date' => $this->selected_date]);
                $stepData['status_id'] = 7;
                $stepData['org_id'] = $this->org_id;

                // Send email about complaint recieved
                if ($complaint->email != null) {
                    SendEmailJob::dispatch($complaint);
                }

                break;
            default:
                // Handle the default case or show an error
                break;
        }

        // Create the ComplaintStep
        $complaint_step = ModelsComplaintStep::create($stepData);

        // Handle file uploads if present
        if ($this->files) {
            foreach ($this->files as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('files', $filename, 'public');

                File::create([
                    'filename' => $filename,
                    'step_id' => $complaint_step->id, // Link file to the complaint step
                ]);
            }
        }

        session()->flash('success', 'Амжилттай хадгаллаа.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $complaint_step = ModelsComplaintStep::findOrFail($id);
        $this->org_id = $complaint_step->org_id;
        $this->complaint_id = $complaint_step->complaint_id;
        $this->desc = $complaint_step->desc;

        $this->selectedAction = $complaint_step->action_taken;

        $this->isEditMode = true;
        $this->step_id = $id;

        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'desc' => 'required',
        ]);

        // Find the existing complaint step
        $complaintStep = ModelsComplaintStep::findOrFail($this->step_id);

        // Update the description
        $complaintStep->desc = $this->desc;

        // Save the updated complaint step
        $complaintStep->save();

        session()->flash('success', 'Амжилттай шинэчиллээ.');

        $this->closeModal();
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        ComplaintStep::find($id)->delete();
        session()->flash('message', 'ComplaintStep Deleted Successfully.');
    }
}