<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Offers extends Model
{
    public function userJobs()
    {
        return $this->hasMany(UserJobs::class, 'id', 'jobs_id');
    }

    public function master()
    {
        return $this->belongsTo(User::class, 'master_id', 'id');
    }

    public function getJobsUserName()
    {
        return DB::table('offers')
            ->join('user_jobs', 'user_jobs.id', '=', 'offers.jobs_id')
            ->join('users', 'users.id', '=', 'user_jobs.create_user_id')
            ->where('offers.id', $this->id)
            ->select('users.name')
            ->value('name'); // tek değer döner
    }
}
