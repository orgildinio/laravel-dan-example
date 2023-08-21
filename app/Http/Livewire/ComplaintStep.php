<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Status;
use Livewire\Component;
use App\Models\Complaint;
use App\Models\ComplaintStep as ModelsComplaintStep;
use App\Models\Organization;

class ComplaintStep extends Component
{
    public $complaint_steps, $org_id, $status_id, $complaint_id, $recieved_user_id, $sent_user_id, $recieved_date, $sent_date, $desc, $orgs, $all_status, $actions;
    public $isOpen = 0;

    public function mount($complaint)
    {
        // dd($complaint);
        $this->complaint_id = $complaint->id;
        $this->sent_user_id = $complaint->created_user_id;
        $this->complaint_steps = ComplaintStep::all();
        $this->orgs = Organization::all();
        $this->all_status = Status::all();
        $this->actions = ['Шилжүүлэх', 'Судалж байгаа', 'Буцаах', 'Шийдвэрлэх', 'Сунгах'];
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

        ModelsComplaintStep::create([
            'org_id' => $this->org_id,
            'complaint_id' => $this->complaint_id,
            'recieved_user_id' => 1,
            'sent_user_id' => $this->sent_user_id,
            'recieved_date' => Carbon::now()->toDateTimeString(),
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
