<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecializationTranslation extends Model
{
    protected $fillable = [
        'specialization_id',
        'locale',
        'title',
        'description'
    ];

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

}
