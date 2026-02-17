<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserJobsImages extends Model
{

    protected $fillable = [
        'user_jobs_id',
        'path',
    ];
}
