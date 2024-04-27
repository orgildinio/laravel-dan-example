<?php

namespace App\Jobs;

use App\Mail\ComplaintNotification;
use App\Mail\ComplaintStatusMail;
use App\Models\User;
use App\Models\Complaint;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user, $complaint;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Complaint $complaint)
    {
        $this->user = $user;
        $this->complaint = $complaint;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Send email using the Mail facade
        Mail::to($this->complaint->email)->send(new ComplaintNotification($this->user, $this->complaint));
    }
}
