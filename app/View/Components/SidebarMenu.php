<?php

namespace App\View\Components;

use App\Models\Complaint;
use App\Models\SourceComplaint;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class SidebarMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct() {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $org_id = Auth::user()->org_id;
        $user_id = Auth::user()->id;

        $currentYear = date('Y');

        // Шинээр ирсэн гомдлын тоо
        if (Auth::user()->org_id == 99) {
            $new_complaints = Complaint::where('organization_id', Auth::user()->org_id)
                ->where('status_id', 0)
                ->whereYear('created_at', $currentYear)
                ->count();
        } else {
            $new_complaints = Complaint::where(function ($query) {
                $query->where('organization_id', Auth::user()->org_id)
                    ->orWhere('second_org_id', Auth::user()->org_id);
            })
                ->where(function ($query) {
                    $query->where('status_id', 0)
                        ->orWhere('second_status_id', 0);
                })
                ->whereYear('created_at', $currentYear)
                ->count();
        }

        // Хүлээн алсан гомдлын тоо
        if (Auth::user()->org_id == 99) {
            $received_complaints = Complaint::where('organization_id', Auth::user()->org_id)
                ->where('status_id', 2)
                ->where('controlled_user_id', Auth::user()->id)
                ->whereYear('created_at', $currentYear)
                ->count();
        } else {
            $received_complaints = Complaint::where(function ($query) {
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
                ->whereYear('created_at', $currentYear)
                ->count();
        }

        // Хянаж байгаа гомдлын тоо
        // $under_control_complaints = Complaint::where('status_id', 3)->where('organization_id', $org_id)->where('controlled_user_id', $user_id)->count();
        if (Auth::user()->org_id == 99) {
            $under_control_complaints = Complaint::where('organization_id', Auth::user()->org_id)
                ->where('status_id', 3)
                ->where('controlled_user_id', Auth::user()->id)
                ->whereYear('created_at', $currentYear)
                ->count();
        } else {
            $under_control_complaints = Complaint::where(function ($query) {
                $query->where('organization_id', Auth::user()->org_id)
                    ->orWhere('second_org_id', Auth::user()->org_id);
            })
                ->where(function ($query) {
                    $query->where('status_id', 3)
                        ->orWhere('second_status_id', 3);
                })
                // ->whereNull('second_status_id')
                ->where(function ($query) {
                    $query->where('controlled_user_id', Auth::user()->id)
                        ->orWhere('second_user_id', Auth::user()->id);
                })
                ->whereYear('created_at', $currentYear)
                ->count();
        }
        // Шилжүүлсэн гомдлын тоо
        $sent_complaints = Complaint::where('organization_id', Auth::user()->org_id)
            ->where('status_id', 1)
            ->where('controlled_user_id', Auth::user()->id)
            ->whereYear('created_at', $currentYear)
            ->count();

        // Шийдвэрлэсэн гомдлын тоо
        // $solved_complaints = Complaint::where('status_id', 6)->where('organization_id', $org_id)->where('controlled_user_id', $user_id)->count();
        if (Auth::user()->org_id == 99) {
            $solved_complaints = Complaint::where('organization_id', Auth::user()->org_id)
                ->where('status_id', 6)
                ->where('controlled_user_id', Auth::user()->id)
                ->whereYear('created_at', $currentYear)
                ->count();
        } else {
            $solved_complaints = Complaint::where(function ($query) {
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
                ->whereYear('created_at', $currentYear)
                ->count();
        }

        // Цуцалсан гомдлын тоо
        $canceled_complaints = Complaint::where('status_id', 4)->where('organization_id', $org_id)->where('controlled_user_id', $user_id)->whereYear('created_at', $currentYear)->count();

        $all_complaints = Complaint::all()->count();


        $source_complaints = SourceComplaint::whereNull('complaint_id')->where('is_modified', false)->whereYear('created_date', $currentYear)->count();

        return view('components.sidebar-menu', ['new_complaints' => $new_complaints, 'received_complaints' => $received_complaints, 'under_control_complaints' => $under_control_complaints, 'solved_complaints' => $solved_complaints, 'canceled_complaints' => $canceled_complaints, 'all_complaints' => $all_complaints, 'sent_complaints' => $sent_complaints, 'source_complaints' => $source_complaints]);
    }
}
