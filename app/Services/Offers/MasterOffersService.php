<?php

namespace App\Services\Offers;

use App\Models\Offers;
use Illuminate\Support\Facades\Auth;

class MasterOffersService
{

    public function get(): array
    {
        try {

            $query = Offers::with([
                'userJobs.imagesRelation:id,user_jobs_id,path',
                'userJobs.creator:id,name',
                'userJobs.countryRelation',
                'userJobs.cityRelation',
                'userJobs.districtRelation',
                'userJobs.specializationsRelation',

            ])
                ->where('create_user_id', Auth::id())->get();


            $query->each(function ($offer) {
                $offer->jobs_user_name = $offer->getJobsUserName();
            });
            return
                $query->toArray();
        } catch (\Throwable $th) {
            return [];
        }
    }
}
