<?php

namespace App\Services\Offers;

use App\Models\Offers;

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
            dd($th);
            return [];
        }
    }
}
