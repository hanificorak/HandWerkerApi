<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class specialization extends Model
{
    protected $fillable = ['slug', 'is_active'];

    public function translations()
    {
        return $this->hasMany(SpecializationTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(SpecializationTranslation::class)
            ->where('locale', app()->getLocale());
    }

}
