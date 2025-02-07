<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationServiceArea extends Model
{
    use HasFactory;

    protected $fillable = ['organization_id', 'country_id', 'soum_district_id', 'bag_khoroo_id'];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function soumDistrict()
    {
        return $this->belongsTo(SoumDistrict::class, 'soum_district_id');
    }

    public function bagKhoroo()
    {
        return $this->belongsTo(BagKhoroo::class, 'bag_khoroo_id');
    }
}
