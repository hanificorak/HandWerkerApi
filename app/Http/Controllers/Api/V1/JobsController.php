<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Jobs\JobsListRequest;
use App\Http\Requests\Api\V1\Jobs\JobsOkRequest;
use App\Http\Requests\Api\V1\Jobs\JobsRequest;
use App\Http\Responses\ApiResponder;
use App\Services\Jobs\JobsService;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    public function __construct(
        protected JobsService $jobsService
    ) {}


    public function get(JobsListRequest $request)
    {
        $result = $jobsService = $this->jobsService->get(
            $request->validated()
        );

        return ApiResponder::success($result, 'Kayıt başarıyla tamamlandı.');
    }

    public function add(JobsRequest $request)
    {
        $result = $jobsService = $this->jobsService->add(
            $request->validated()
        );

        if ($result) {
            return ApiResponder::success($result, 'Kayıt başarıyla tamamlandı.');
        } else {
            return ApiResponder::error("Kayıt işlemi başarısız.");
        }
    }

    public function jobsOk(JobsOkRequest $request)
    {
        $result = $jobsService = $this->jobsService->jobsOk(
            $request->validated()
        );

        if ($result) {
            return ApiResponder::success($result, 'Kayıt başarıyla tamamlandı.');
        } else {
            return ApiResponder::error("Kayıt işlemi başarısız.");
        }
    }
}
