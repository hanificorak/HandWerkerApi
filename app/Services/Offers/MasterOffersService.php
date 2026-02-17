<?php

namespace App\Services\Offers;

use App\Models\Offers;
use App\Models\UserJobs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MasterOffersService
{

    public function get(): array
    {
        try {

            $query = Offers::with([
                'userJobs.imagesRelation:id,user_jobs_id,path',
                'userJobs.creator',
                'userJobs.countryRelation',
                'userJobs.cityRelation',
                'userJobs.districtRelation',
                'userJobs.specializationsRelation',
            ])
            ->where('create_user_id', Auth::id())
            ->get()
            ->toArray();

            return $query;
        } catch (\Throwable $th) {
            dd($th);
            return [];
        }
    }
}
