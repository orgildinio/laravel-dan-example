<?php

namespace App\Models;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationServiceArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'district',
        'khoroo',
        'street',
        'building_numbers'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}