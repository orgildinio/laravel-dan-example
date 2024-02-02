<?php

namespace App\View\Components;

use Carbon\Carbon;
use App\Models\Complaint;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class DashboardTzeShow extends Component
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
        $org_id = Auth::user()->org_id;
        $all_comp = Complaint::where('organization_id', $org_id)->count();
        $new_comp = Complaint::where('status_id', 0)->where('organization_id', $org_id)->count();
        $rec_comp = Complaint::where('status_id', 2)->where('organization_id', $org_id)->count();
        $ctl_comp = Complaint::where('status_id', 3)->where('organization_id', $org_id)->count();
        $slv_comp = Complaint::where('status_id', 6)->where('organization_id', $org_id)->count();
        $cnc_comp = Complaint::where('status_id', 4)->where('organization_id', $org_id)->count();
        $exp_comp = Complaint::where('expire_date', '<=', Carbon::now())->where('organization_id', $org_id)->count();

        return view('components.dashboard-tze-show', ['all_comp' => $all_comp, 'new_comp' => $new_comp, 'rec_comp' => $rec_comp, 'ctl_comp' => $ctl_comp, 'slv_comp' => $slv_comp, 'cnc_comp' => $cnc_comp, 'exp_comp' => $exp_comp]);
    }
}
