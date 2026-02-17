<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Offers\JobsOfferItemRequest;
use App\Http\Requests\Api\V1\Offers\JobsOfferRequest;
use App\Http\Requests\Api\V1\Offers\OfferStatusChangeRequest;
use App\Http\Responses\ApiResponder;
use App\Services\Offers\MasterOffersService;
use App\Services\Offers\OffersService;
use Illuminate\Support\Facades\Auth;

class MasterOfferController extends Controller
{
    public function __construct(
        protected MasterOffersService $masterOfferService
    ) {}


    public function get()
    {
        $result = $masterOfferService = $this->masterOfferService->get();
        
        return ApiResponder::success($result, 'Offers Get Success Result.');
    }
}
