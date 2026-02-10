<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    public function userJobs()
    {
        return $this->hasMany(UserJobs::class, 'city', 'code');
    }
    //
}
