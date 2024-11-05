<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $uploads = '/files/';

    protected $fillable = ['filename', 'complaint_id'];

    public function getFileAttribute($file)
    {
        return $this->uploads . $file;
    }
}