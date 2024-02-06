<?php

namespace App\Models;

use App\Models\Complaint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;

    public function complaint()
    {
        return $this->hasMany(Complaint::class);
    }
}
