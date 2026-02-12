<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    public function userJobs()
    {
        return $this->hasMany(UserJobs::class, 'jobs_id', 'id');
    }

    public function master()
    {
        return $this->belongsTo(User::class, 'master_id', 'id');
    }
}
