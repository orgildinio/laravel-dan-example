<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Status;
use Livewire\Component;
use App\Models\Complaint;
use App\Models\ComplaintStep as ModelsComplaintStep;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;

class ComplaintStep extends Component
{
    public $complaint_steps, $org_id, $status_id, $complaint_id, $recieved_user_id, $sent_user_id, $recieved_date, $sent_date, $desc, $orgs, $all_status, $actions, $selectedAction;
    public $isOpen = 0;

    public function mount($complaint)
    {
        // dd($complaint);
        $this->complaint_id = $complaint->id;
        // $this->sent_user_id = $complaint->created_user_id;
        // $this->status_id = $complaint->status_id;
        $this->org_id = $complaint->organization_id;
        $this->complaint_steps = ComplaintStep::all();
        $this->orgs = Organization::all();
        $this->all_status = Status::all();
        $this->actions = ['Тайлбар', 'Шилжүүлэх', 'Хянаж байгаа', 'Цуцлах', 'Буцаах', 'Шийдвэрлэх', 'Сунгах', 'ТЗЭ-рүү шилжүүлэх'];
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
        $this->isOpen = true;
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
        // if ($this->status_id == 1) {
        //     $complaint->status_id = 0;
        //     $complaint->organization_id = $this->org_id;
        //     $complaint->save();
        // } else {
        //     $complaint->status_id = $this->status_id;
        //     $complaint->save();
        // }

        switch ($this->selectedAction) {
            case 'Тайлбар':
                // Тайлбар бичихэд төлөв өөрчлөгдөхгүй
                $complaint->save();
                break;
            case 'Шилжүүлэх':
                // Байгууллага дотроо өөр хүнд шилжүүлэхэд төлөв тухайн хүн хүлээн авсан болно
                $complaint->status_id = 2;
                // $complaint->controlled_user_id = 2; // Шилжүүлсэн ажилтны id-г өгөх
                $complaint->save();
                break;
            case 'ТЗЭ-рүү шилжүүлэх':
                // ТЗЭ рүү шилжүүлэхэд төлөв шинээр ирсэн болно
                $complaint->status_id = 0;
                $complaint->organization_id = $this->org_id;
                $complaint->save();
                break;
            case 'Хянаж байгаа':
                // Төлөв хянаж байгаа болно
                $complaint->status_id = 3;
                $complaint->save();
                break;
            case 'Цуцлах':
                // Төлөв цуцалсан болно
                $complaint->status_id = 4;
                $complaint->save();
                break;
            case 'Буцаах':
                // Буцаах үед төлөв шинээр ирсэн төлөвт орох эсэх!!!
                $complaint->status_id = 0;
                $complaint->organization_id = 1; //  ЭХЗХ руу буцаана
                $complaint->save();
                break;
            case 'Шийдвэрлэх':
                // Төлөв шийдвэрлэсэн болно
                $complaint->status_id = 6;
                $complaint->save();
                break;
            case 'Сунгах':
                // Шийдвэрлэх хугацааг 48 цагаар сунгах, төлөв өөрчлөгдөхгүй
                $currentDate = Carbon::parse($complaint->complaint_date);
                $complaint->complaint_date = $currentDate->addHours(48);
                $complaint->save();
                break;

            default:
                // Handle the default case or show an error
                $complaint->save();
                break;
        }

        ModelsComplaintStep::create([
            'org_id' => Auth::user()->org_id,
            'complaint_id' => $this->complaint_id,
            'sent_user_id' => Auth::user()->id,
            'status_id' => $complaint->status_id == 0 ? 1 : $complaint->status_id,
            'sent_date' => Carbon::now()->toDateTimeString(),
            'desc' => $this->desc
        ]);

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
