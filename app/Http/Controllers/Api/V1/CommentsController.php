<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Jobs\JobPointRequest;
use App\Http\Requests\Api\V1\Jobs\JobsListRequest;
use App\Http\Requests\Api\V1\Jobs\JobsOkRequest;
use App\Http\Requests\Api\V1\Jobs\JobsRequest;
use App\Http\Responses\ApiResponder;
use App\Services\Jobs\CommentsService;
use App\Services\Jobs\JobsService;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function __construct(
        protected CommentsService $commentService
    ) {}


   
    public function jobsPoint(JobPointRequest $request)
    {
        $result = $commentService = $this->commentService->jobsPoint(
            $request->validated()
        );

        if ($result["status"]) {
            return ApiResponder::success($result["status"], 'Kayıt başarıyla tamamlandı.');
        } else {
            return ApiResponder::error($result["message"]);
        }
    }
}
