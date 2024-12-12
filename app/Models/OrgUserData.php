<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgUserData extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'org_user_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usercode',
        'lastname',
        'firstname',
        'regnum',
        'phone',
        'aimagCityName',
        'sumDistrictName',
        'bagKhorooName',
        'buildingStreet',
        'door',
        'mail',
        'org_id'
    ];
}
