<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $appends = ['specialization_name', 'points'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'expert_id',
        'email_verification_code',
        'country_id',
        'district_id',
        'city_id'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function jobs()
    {
        return $this->hasMany(UserJobs::class, 'create_user_id', 'id');
    }

    


    public function specializationsRelation()
    {
        return $this->belongsTo(specialization::class, 'expert_id', 'id');
    }

    public function getSpecializationNameAttribute()
    {
        return $this->specializationsRelation?->translation->title;
    }

    public function masterPoints()
    {
        return $this->hasMany(MasterPoints::class, 'master_id', 'id');
    }
    
    public function getPointsAttribute(): int
    {
        $avg = $this->masterPoints()->avg('point');

        if (!$avg) {
            return 0;
        }

        return (int) round($avg);
    }
}
