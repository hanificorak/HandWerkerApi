<?php

namespace App\Models;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserJobs extends Model
{
    // Status =  0 = Beklemede | 1 = Onaylandı, Teklifler inceleniyor ve bekleniyor... \ 2 = Usta ile Analışldı \ 3 = Tamamlandı | 4 = iptal Edildibb0

    protected $table = 'user_jobs';
    protected $appends = ['country_name', 'city_name', 'district_name', 'specialization_name', 'images', 'points'];

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

    public function specializationsRelation()
    {
        return $this->belongsTo(specialization::class, 'category', 'id');
    }

    public function getSpecializationNameAttribute()
    {
        return $this->specializationsRelation->translation->title;
    }

    public function offers()
    {
        return $this->hasMany(Offers::class, 'jobs_id', 'id');
    }

    public function imagesRelation()
    {
        return $this->hasMany(UserJobsImages::class, 'user_jobs_id', 'id');
    }

    public function getImagesAttribute(): array
    {
        if (!$this->relationLoaded('imagesRelation')) {
            return [];
        }

        return $this->imagesRelation
            ->pluck('path')
            ->map(fn($path) => url($path))
            ->values()
            ->toArray();
    }

    public function getPointsAttribute(): int
    {
        return MasterPoints::where('job_id', $this->id)
            ->where('create_user_id', FacadesAuth::id())
            ->value('point') ?? 0;
    }
}
