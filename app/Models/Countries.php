<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    //

    public function userJobs()
    {
        return $this->hasMany(UserJobs::class, 'country', 'id');
    }

}
