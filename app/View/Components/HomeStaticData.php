<?php

namespace App\View\Components;

use App\Models\Complaint;
use Illuminate\View\Component;

class HomeStaticData extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $received_complaints = Complaint::where('status_id', 2)->count();
        $under_control_complaints = Complaint::where('status_id', 3)->count();
        $solved_complaints = Complaint::where('status_id', 6)->count();

        return view('components.home-static-data', ['received_complaints' => $received_complaints, 'under_control_complaints' => $under_control_complaints, 'solved_complaints' => $solved_complaints]);
    }
}