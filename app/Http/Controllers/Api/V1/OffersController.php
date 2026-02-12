<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Offers\JobsOfferRequest;
use App\Http\Responses\ApiResponder;
use App\Services\Offers\OffersService;

class OffersController extends Controller
{
    public function __construct(
        protected OffersService $offersService
    ) {}

    
    public function get(JobsOfferRequest $request)
    {
        $result = $offersService = $this->offersService->get(
            $request->validated()
        );

        if ($result) {
            return ApiResponder::success($result, 'List başarıyla tamamlandı.');
        } else {
            return ApiResponder::error("Kayıt işlemi başarısız.");
        }
    }




}
