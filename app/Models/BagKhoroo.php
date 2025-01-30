<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagKhoroo extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'soum_district_id'];

    public function soumDistrict()
    {
        return $this->belongsTo(SoumDistrict::class);
    }
}
