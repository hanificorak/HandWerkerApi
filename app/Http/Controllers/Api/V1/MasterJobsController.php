<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Master\Jobs\MasterJobsAddOfferRequest;
use App\Http\Requests\Api\V1\Master\Jobs\MasterJobsListRequest;
use App\Http\Responses\ApiResponder;
use App\Services\Jobs\MasterJobsService;

class MasterJobsController extends Controller
{
    public function __construct(
        protected MasterJobsService $masterJobsService
    ) {}



    public function get(MasterJobsListRequest $request)
    {
        $result = $masterJobsService = $this->masterJobsService->get(
            $request->validated()
        );

        return ApiResponder::success($result, 'Master Job Success Result.');
    }

    public function addOffer(MasterJobsAddOfferRequest $request)
    {
        $result = $masterJobsService = $this->masterJobsService->addOffer(
            $request->validated()
        );

        return ApiResponder::success($result, 'Teklifiniz başarıyla gönderildi.');
    }
}
