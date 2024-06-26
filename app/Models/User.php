<?php

namespace App\Models;

use App\Models\Role;
use App\Models\DanUser;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'org_id',
        'division',
        'danImage',
        'danFirstname',
        'danLastname',
        'danRegnum',
        'danAimagCityName',
        'danSoumDistrictName',
        'danBagKhorooName',
        'danPassportAddress',
        'danGender',
        'role_id',
        'phone',
        'companyName',
        'companyType',
        'companyRegnum',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function org()
    {
        return $this->belongsTo(Organization::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function danUser()
    {
        return $this->hasOne(DanUser::class);
    }
}
