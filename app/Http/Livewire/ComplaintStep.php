<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Status;
use Livewire\Component;
use App\Models\Complaint;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use App\Models\ComplaintStep as ModelsComplaintStep;

class ComplaintStep extends Component
{
    public $complaint_steps, $org_id, $status_id, $complaint_id, $recieved_user_id, $sent_user_id, $recieved_date, $sent_date, $desc, $orgs, $all_status, $actions, $selectedAction, $controlled_user_id, $employees, $selected_user_id, $second_user_id;
    public $isOpen = 0;
    public $showPermissionWarning = false;

    public function mount($complaint)
    {
        // dd($complaint);
        $this->complaint_id = $complaint->id;
        $this->org_id = $complaint->organization_id;
        $this->controlled_user_id = $complaint->controlled_user_id;
        $this->second_user_id = $complaint->second_user_id;
        $this->complaint_steps = ComplaintStep::all();
        $this->orgs = Organization::all();
        $this->all_status = Status::all();
        if (Auth::user()->org_id == 99) {
            $this->actions = ['Тайлбар', 'Шилжүүлэх', 'Хянаж байгаа', 'Цуцлах', 'Шийдвэрлэх', 'Сунгах', 'ТЗЭ-рүү шилжүүлэх'];
        } else {
            $this->actions = ['Тайлбар', 'Шилжүүлэх', 'Хянаж байгаа', 'Шийдвэрлэх', 'Сунгах'];
        }
        $this->employees = User::where('org_id', $this->org_id)->where('id', '!=', Auth::user()->id)->orderBy('name', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.complaint-step');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        // $this->isOpen = true;
        // Check user permissions before opening the modal
        if (Auth::user()->id == $this->controlled_user_id || Auth::user()->id == $this->second_user_id) {
            $this->isOpen = true;
            $this->showPermissionWarning = false;
        } else {
            // Optionally, you can notify the user that they don't have the required permission
            $this->showPermissionWarning = true;
            session()->flash('message', 'You do not have permission to open the modal.');
        }
    }

    public function closeModal()
    {
        $this->isOpen = false;
        // Dispatch a browser event to reload the page after the modal closes
        $this->dispatchBrowserEvent('reloadPage');
    }

    private function resetInputFields()
    {
        $this->desc = '';
    }

    public function store()
    {
        $this->validate([
            'desc' => 'required',
        ]);

        $complaint = Complaint::findOrFail($this->complaint_id);

        switch ($this->selectedAction) {
            case 'Тайлбар':
                // Тайлбар бичихэд төлөв өөрчлөгдөхгүй
                $complaint->save();
                ModelsComplaintStep::create([
                    'org_id' => $this->org_id,
                    'complaint_id' => $this->complaint_id,
                    'sent_user_id' => Auth::user()->id,
                    'status_id' => 8,
                    'sent_date' => Carbon::now()->toDateTimeString(),
                    'desc' => $this->desc
                ]);
                break;
            case 'Шилжүүлэх':
                // Байгууллага дотроо өөр хүнд шилжүүлэхэд төлөв тухайн хүн хүлээн авсан болно
                $complaint->status_id = 2;
                $complaint->controlled_user_id = $this->selected_user_id; // Шилжүүлсэн ажилтны id-г өгөх
                $complaint->save();
                ModelsComplaintStep::create([
                    'org_id' => $this->org_id,
                    'complaint_id' => $this->complaint_id,
                    'sent_user_id' => Auth::user()->id,
                    'status_id' => 1,
                    'sent_date' => Carbon::now()->toDateTimeString(),
                    'desc' => $this->desc
                ]);
                break;
            case 'ТЗЭ-рүү шилжүүлэх':
                // ТЗЭ рүү шилжүүлэхэд төлөв хянаж байгаа төлөвтэй болно
                $complaint->status_id = 1;
                $complaint->second_org_id = $this->org_id;
                $complaint->second_status_id = 0;
                $complaint->save();
                ModelsComplaintStep::create([
                    'org_id' => $complaint->organization_id,
                    'complaint_id' => $this->complaint_id,
                    'sent_user_id' => Auth::user()->id,
                    'status_id' => 1,
                    'sent_date' => Carbon::now()->toDateTimeString(),
                    'desc' => $this->desc
                ]);
                break;
            case 'Хянаж байгаа':
                // Төлөв хянаж байгаа болно
                if ($complaint->second_org_id == null) {
                    $complaint->status_id = 3;
                    $complaint->save();
                    ModelsComplaintStep::create([
                        'org_id' => $complaint->organization_id,
                        'complaint_id' => $this->complaint_id,
                        'sent_user_id' => Auth::user()->id,
                        'status_id' => 3,
                        'sent_date' => Carbon::now()->toDateTimeString(),
                        'desc' => $this->desc
                    ]);
                } else {
                    $complaint->second_status_id = 3;
                    $complaint->save();
                    ModelsComplaintStep::create([
                        'org_id' => $complaint->second_org_id,
                        'complaint_id' => $this->complaint_id,
                        'sent_user_id' => Auth::user()->id,
                        'status_id' => 3,
                        'sent_date' => Carbon::now()->toDateTimeString(),
                        'desc' => $this->desc
                    ]);
                }

                break;
            case 'Цуцлах':
                // Төлөв цуцалсан болно
                $complaint->status_id = 4;
                $complaint->save();
                ModelsComplaintStep::create([
                    'org_id' => $this->org_id,
                    'complaint_id' => $this->complaint_id,
                    'sent_user_id' => Auth::user()->id,
                    'status_id' => 4,
                    'sent_date' => Carbon::now()->toDateTimeString(),
                    'desc' => $this->desc
                ]);
                break;
                // case 'Буцаах':
                //     // Буцаах үед төлөв шинээр ирсэн төлөвт орох эсэх!!!
                //     $complaint->status_id = 0;
                //     $complaint->organization_id = 1; //  ЭХЗХ руу буцаана
                //     $complaint->save();
                //     break;
            case 'Шийдвэрлэх':
                // Төлөв шийдвэрлэсэн болно
                if ($complaint->second_org_id == null) {

                    $complaint->status_id = 6;
                    $complaint->save();
                    ModelsComplaintStep::create([
                        'org_id' => $this->org_id,
                        'complaint_id' => $this->complaint_id,
                        'sent_user_id' => Auth::user()->id,
                        'status_id' => 6,
                        'sent_date' => Carbon::now()->toDateTimeString(),
                        'desc' => $this->desc
                    ]);
                } else {
                    if (Auth::user()->org_id == 99) {
                        $complaint->status_id = 6;
                        $complaint->save();
                        ModelsComplaintStep::create([
                            'org_id' => $complaint->organization_id,
                            'complaint_id' => $this->complaint_id,
                            'sent_user_id' => Auth::user()->id,
                            'status_id' => 6,
                            'sent_date' => Carbon::now()->toDateTimeString(),
                            'desc' => $this->desc
                        ]);
                    } else {
                        $complaint->second_status_id = 6;
                        $complaint->save();
                        ModelsComplaintStep::create([
                            'org_id' => $complaint->second_org_id,
                            'complaint_id' => $this->complaint_id,
                            'sent_user_id' => Auth::user()->id,
                            'status_id' => 6,
                            'sent_date' => Carbon::now()->toDateTimeString(),
                            'desc' => $this->desc
                        ]);
                    }
                }
                break;
            case 'Сунгах':
                // Шийдвэрлэх хугацааг 48 цагаар сунгах, төлөв өөрчлөгдөхгүй
                $expire_date = Carbon::parse($complaint->expire_date);
                $complaint->expire_date = $expire_date->addHours(48);
                $complaint->save();
                ModelsComplaintStep::create([
                    'org_id' => $this->org_id,
                    'complaint_id' => $this->complaint_id,
                    'sent_user_id' => Auth::user()->id,
                    'status_id' => 7,
                    'sent_date' => Carbon::now()->toDateTimeString(),
                    'desc' => $this->desc
                ]);
                break;

            default:
                // Handle the default case or show an error
                // $complaint->save();
                break;
        }

        // ModelsComplaintStep::create([
        //     'org_id' => $this->org_id,
        //     'complaint_id' => $this->complaint_id,
        //     'sent_user_id' => Auth::user()->id,
        //     // 'status_id' => $complaint->status_id == 0 ? 1 : $complaint->status_id,
        //     'status_id' => $complaint->status_id == 0 ? 1 : $complaint->status_id,
        //     'sent_date' => Carbon::now()->toDateTimeString(),
        //     'desc' => $this->desc
        // ]);

        session()->flash(
            'message',
            $this->id ? 'ComplaintStep Updated Successfully.' : 'ComplaintStep Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $complaint_steps = ModelsComplaintStep::findOrFail($id);
        $this->org_id = $complaint_steps->org_id;
        $this->complaint_id = $complaint_steps->complaint_id;
        $this->desc = $complaint_steps->desc;

        $this->openModal();
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
