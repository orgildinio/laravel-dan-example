<?php

namespace App\Models;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationNumbers extends Model
{
    use HasFactory;

    protected $fillable = ['phone_number', 'organization_id'];

    public function org()
    {
        return $this->belongsTo(Organization::class);
    }
}
