<?php

namespace App\Models;

use App\Models\File;
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

    protected $fillable = ['lastname', 'firstname', 'registerNumber', 'phone', 'country', 'district', 'khoroo', 'addressDetail', 'complaint', 'file_id', 'category_id', 'status_id', 'channel_id', 'organization_id', 'created_user_id', 'updated_user_id', 'email', 'audio_file_id', 'complaint_type_id', 'energy_type_id', 'complaint_maker_type_id', 'complaint_date', 'complaint_maker_org_name', 'complaint_type_summary_id', 'controlled_user_id', 'expire_date', 'second_org_id', 'second_status_id', 'second_user_id'];
    // protected $guarded = ['consumer_code'];

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
    public function complaintType()
    {
        return $this->belongsTo(ComplaintType::class);
    }
    public function energyType()
    {
        return $this->belongsTo(EnergyType::class);
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
}
