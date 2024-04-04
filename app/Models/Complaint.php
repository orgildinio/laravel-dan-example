<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\File;
use App\Models\User;
use App\Models\Rating;
use App\Models\Status;
use App\Models\Channel;
use App\Models\Category;
use App\Models\EnergyType;
use App\Models\Organization;
use App\Models\ComplaintStep;
use App\Models\ComplaintType;
use App\Models\ComplaintMakerType;
use App\Models\ComplaintTypeSummary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = ['lastname', 'firstname', 'registerNumber', 'phone', 'country', 'district', 'khoroo', 'addressDetail', 'complaint', 'file_id', 'category_id', 'status_id', 'channel_id', 'organization_id', 'created_user_id', 'updated_user_id', 'email', 'audio_file_id', 'complaint_type_id', 'energy_type_id', 'complaint_maker_type_id', 'complaint_date', 'complaint_maker_org_name', 'complaint_type_summary_id', 'controlled_user_id', 'expire_date', 'second_org_id', 'second_status_id', 'second_user_id', 'serial_number', 'source_number'];
    // protected $guarded = ['consumer_code'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($complaint) {
            // Generate the serial number if it's not set
            if (empty($complaint->serial_number)) {
                $complaint->serial_number = static::generateSerialNumber();
            }
        });
    }

    protected static function generateSerialNumber()
    {
        // Use the current date in the format "yyyymmdd" followed by a dash and a unique counter
        $currentDay = now()->format('Ymd');
        $latestComplaint = static::where('serial_number', 'like', $currentDay . '-%')->latest('serial_number')->first();

        if ($latestComplaint) {
            $latestCounter = intval(substr($latestComplaint->serial_number, -5));
            $counter = str_pad($latestCounter + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $counter = '00001';
        }

        return $currentDay . '-' . $counter;
    }

    // Өргөдөл гомдол шийдвэрлэх хугацаа дууссан эсэхийг шалгах функц
    public function hasExpired()
    {
        // Parse the expire_date attribute as a Carbon instance
        $expireDate = Carbon::parse($this->expire_date);

        // Compare with the current date and time
        return $expireDate->isPast();
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function audioFile()
    {
        return $this->belongsTo(File::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function secondStatus()
    {
        return $this->belongsTo(Status::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function secondOrg()
    {
        return $this->belongsTo(Organization::class);
    }
    public function complaintType()
    {
        return $this->belongsTo(ComplaintType::class);
    }
    public function energyType()
    {
        return $this->belongsTo(EnergyType::class);
    }
    public function controlledUser()
    {
        return $this->belongsTo(User::class);
    }
    public function complaintMakerType()
    {
        return $this->belongsTo(ComplaintMakerType::class);
    }
    public function complaintTypeSummary()
    {
        return $this->belongsTo(ComplaintTypeSummary::class);
    }
    public function complaintSteps()
    {
        return $this->hasMany(ComplaintStep::class);
    }
    public function aimag()
    {
        return $this->belongsTo(Aimag::class);
    }
    public function soum()
    {
        return $this->belongsTo(Soum::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
