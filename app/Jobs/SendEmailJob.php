<?php

namespace App\Jobs;

use App\Mail\ComplaintNotification;
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
    public $complaint;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Complaint $complaint)
    {
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
        Mail::to($this->complaint->email)->send(new ComplaintNotification($this->complaint));
    }
}
