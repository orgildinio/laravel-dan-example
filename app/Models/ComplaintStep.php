<?php

namespace App\Models;

use App\Models\Status;
use App\Models\Complaint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComplaintStep extends Model
{
    use HasFactory;

    protected $fillable = ['org_id', 'complaint_id', 'recieved_user_id', 'sent_user_id', 'recieved_date', 'sent_date', 'desc', 'status_id', 'amount', 'file_id'];

    public function org()
    {
        return $this->belongsTo(Organization::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function sentUser()
    {
        return $this->belongsTo(User::class);
    }

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}
