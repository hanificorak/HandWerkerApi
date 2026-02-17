<?php

namespace App\Services\Offers;

use App\Models\Offers;
use App\Models\UserJobs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OffersService
{
    public function get(array $data): array
    {
        try {

            $job_id = $data['job_id'];

            $query = Offers::with('master')
                ->where('jobs_id', $job_id)
                ->get()->toArray();

            return $query;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function getItem(array $data): array
    {
        try {

            $offer_id = $data['offer_id'];

            $query = Offers::with('master')
                ->where('id', $offer_id)
                ->get()->toArray();

            return $query;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function offerApproved(array $data): bool
    {
        try {

            $offer_id = $data['offer_id'];

            $mdl = Offers::find($offer_id);
            $mdl->status_change_date = Carbon::now();
            $mdl->status_change_user_id = Auth::user()->id;
            $mdl->status = 1;
            $mdl->save();

            $jobs = UserJobs::find($mdl->jobs_id);
            $jobs->master_id = $mdl->master_id;
            $jobs->status = 2;

            return $jobs->save();
        } catch (\Throwable $th) {

            return false;
        }
    }

    public function offerRejected(array $data): bool
    {
        try {

            $offer_id = $data['offer_id'];

            $mdl = Offers::find($offer_id);
            $mdl->status_change_date = Carbon::now();
            $mdl->status_change_user_id = Auth::user()->id;
            $mdl->status = 2;

            return $mdl->save();
        } catch (\Throwable $th) {

            return false;
        }
    }
}
