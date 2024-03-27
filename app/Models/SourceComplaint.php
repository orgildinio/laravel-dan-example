<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourceComplaint extends Model
{
    use HasFactory;

    protected $fillable = ['created_date', 'source', 'quarter', 'assigned_at', 'number', 'city', 'register_no', 'phone', 'content', 'email', 'type', 'address', 'district', 'fullname', 'path'];
}
