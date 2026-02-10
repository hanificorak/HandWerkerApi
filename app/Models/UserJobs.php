<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserJobs extends Model
{
    // Status =  0 = Beklemede | 1 = Onaylandı, Teklifler inceleniyor ve bekleniyor... \ 2 = Usta ile Analışldı \ 3 = Tamamlandı | 4 = iptal Edildibb0

    protected $table = 'user_jobs';
    protected $appends = ['country_name', 'city_name','district_name'];


    public function creator()
    {
        return $this->belongsTo(User::class, 'create_user_id', 'id');
    }

    public function countryRelation()
    {
        return $this->belongsTo(Countries::class, 'country', 'id');
    }

    public function getCountryNameAttribute()
    {
        return $this->countryRelation?->name;
    }

    public function cityRelation()
    {
        return $this->belongsTo(Cities::class, 'city', 'code');
    }

    public function getCityNameAttribute()
    {
        if (!$this->cityRelation) {
            return null;
        }

        return $this->cityRelation->name;
    }

    public function districtRelation()
    {
        return $this->belongsTo(Districts::class, 'district', 'id');
    }

    public function getDistrictNameAttribute()
    {
        return $this->districtRelation?->name;
    }

}
