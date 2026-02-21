<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterPoints extends Model
{

    protected $appends = ['images'];


    public function imagesRelation()
    {
        return $this->hasMany(PointsImages::class, 'points_id', 'id');
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
}
