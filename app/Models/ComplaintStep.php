<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintStep extends Model
{
    use HasFactory;

    protected $fillable = ['org_id', 'complaint_id', 'recieved_user_id', 'sent_user_id', 'recieved_date', 'sent_date', 'desc'];

    public function org()
    {
        return $this->belongsTo(Organization::class);
    }
}
