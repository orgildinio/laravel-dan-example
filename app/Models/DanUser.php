<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'personId',
        'firstname',
        'lastname',
        'regnum',
        'aimagCityName',
        'soumDistrictName',
        'bagKhorooName',
        'passportAddress',
        'image',
        'gender',
        'user_id'
    ];
}
