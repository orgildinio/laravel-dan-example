<?php

namespace App\Jobs;

use App\Mail\TzeNotificationMail;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendTzeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $complaint;
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Complaint $complaint, User $user)
    {
        $this->complaint = $complaint;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new TzeNotificationMail($this->complaint, $this->user));
    }
}