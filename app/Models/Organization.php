<?php

namespace App\Models;

use App\Models\Complaint;
use App\Models\OrganizationNumbers;
use App\Models\OrganizationServiceArea;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'plant_id', 'org_number_id'];

    public function complaint()
    {
        return $this->hasMany(Complaint::class);
    }

    public function orgNumber()
    {
        return $this->hasMany(OrganizationNumbers::class);
    }

    public function serviceAreas()
    {
        return $this->hasMany(OrganizationServiceArea::class);
    }
}