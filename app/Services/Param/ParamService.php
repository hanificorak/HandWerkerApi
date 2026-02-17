<?php

namespace App\Services\Param;

use App\Http\Responses\ApiResponder;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Districts;
use App\Models\specialization;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ParamService
{
    public function AuthParam(): array
    {

        $specializations = specialization::query()
            ->where('is_active', true)
            ->with('translation')
            ->get();

        return [
            "specializ" => $specializations,
            "countries" => Countries::where('is_active', 1)->get(),
            "cities" => Cities::select('code as id', 'name', 'country_id')->get(),
            "districts" => Districts::all()
        ];
    }

    public function JobsParam(): array
    {

        $specializations = specialization::query()
            ->where('is_active', true)
            ->with('translation')
            ->get();

        return [
            "specializ" => $specializations,
            "countries" => Countries::where('is_active', 1)->get(),
            "cities" => Cities::select('code as id', 'name', 'country_id')->get(),
            "districts" => Districts::all()
        ];
    }

    public function getSearchJobsFilterParam(): array
    {
        try {

            return [
                "country" => Countries::all(),
                "cities" => Cities::all(),
                "districts" => Districts::all(),
                "spec" => specialization::query()
                    ->where('is_active', true)
                    ->with('translation')
                    ->get()

            ];
        } catch (\Throwable $th) {
            return [];
        }
    }
}
