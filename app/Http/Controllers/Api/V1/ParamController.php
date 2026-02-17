<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponder;
use App\Services\Param\ParamService;
use Illuminate\Http\Request;

class ParamController extends Controller
{
    public function __construct(
        protected ParamService $paramService
    ) {}

    public function AuthParam()
    {
        $result = $paramService = $this->paramService->AuthParam();

        return ApiResponder::success($result, 'Param Ok');
    }

    public function JobsParam()
    {
        $result = $paramService = $this->paramService->JobsParam();

        return ApiResponder::success($result, 'Param Ok');
    }

    public function getSearchJobsFilterParam()
    {
        $result = $paramService = $this->paramService->getSearchJobsFilterParam();

        return ApiResponder::success($result, 'Param Ok');
    }
}
