<?php

namespace App\View\Components;

use App\Models\Complaint;
use Illuminate\View\Component;

class SidebarMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $new_complaints = Complaint::where('status_id', 0)->count();
        $received_complaints = Complaint::where('status_id', 1)->count();
        $under_control_complaints = Complaint::where('status_id', 3)->count();
        $solved_complaints = Complaint::where('status_id', 4)->count();
        $canceled_complaints = Complaint::where('status_id', 5)->count();
        $all_complaints = Complaint::all()->count();

        return view('components.sidebar-menu', ['new_complaints' => $new_complaints, 'received_complaints' => $received_complaints, 'under_control_complaints' => $under_control_complaints, 'solved_complaints' => $solved_complaints, 'canceled_complaints' => $canceled_complaints, 'all_complaints' => $all_complaints]);
    }
}
