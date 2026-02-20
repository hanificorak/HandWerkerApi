<?php

namespace App\Services\Jobs;

use App\Models\Cities;
use App\Models\Countries;
use App\Models\Districts;
use App\Models\Offers;
use App\Models\specialization;
use App\Models\UserJobs;
use App\Models\UserJobsImages;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MasterJobsService
{

    public function get(array $data): array
    {
        try {
            $query = UserJobs::query()
                ->with([
                    'creator',
                    'countryRelation',
                    'cityRelation',
                    'districtRelation',
                    'specializationsRelation',
                    'imagesRelation:id,user_jobs_id,path',
                ])
                ->addSelect([
                    'offer_id' => DB::table('offers')
                        ->select('id')
                        ->whereColumn('offers.jobs_id', 'user_jobs.id')
                        ->where('offers.create_user_id', Auth::id())
                        ->limit(1)
                ]);

            if (!empty($data['country_id'])) {
                $query->where('country', $data['country_id']);
            }

            if (!empty($data['category_id'])) {
                $query->where('category', $data['category_id']);
            }

            if (!empty($data['city_id'])) {
                $query->where('city', $data['city_id']);
            }

            if (!empty($data['district_id'])) {
                $query->where('district', $data['district_id']);
            }

            return $query->get()->toArray();
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function addOffer(array $data): bool
    {
        try {

            $job_id = $data['job_id'];
            $message = $data['message'];
            $price = $data['price'];

            $mdl = new Offers();
            $mdl->created_at = Carbon::now();
            $mdl->create_user_id  = Auth::id();
            $mdl->jobs_id = $job_id;
            $mdl->description = $message;
            $mdl->price = $price;
            $mdl->master_id = Auth::id();

            return $mdl->save();
        } catch (\Throwable $th) {
            return false;
        }
    }
}
