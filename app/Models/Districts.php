<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    public function userJobs()
    {
        return $this->hasMany(UserJobs::class, 'district', 'id');
    }

}
