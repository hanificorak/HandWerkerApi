<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Offers\JobsOfferItemRequest;
use App\Http\Requests\Api\V1\Offers\JobsOfferRequest;
use App\Http\Requests\Api\V1\Offers\OfferStatusChangeRequest;
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

        return ApiResponder::success($result, 'Offers Get Success Result.');
    }

    public function getItem(JobsOfferItemRequest $request)
    {
        $result = $offersService = $this->offersService->getItem(
            $request->validated()
        );

        return ApiResponder::success($result, 'Offers Get Item Success Result.');
    }

    public function offerApproved(OfferStatusChangeRequest $request)
    {
        $result = $offersService = $this->offersService->offerApproved(
            $request->validated()
        );

        if ($result) {
            return ApiResponder::success($result, 'Teklif kaydı başarıyla onaylandı.');
        } else {
            return ApiResponder::error("Kayıt işlemi başarısız.");
        }
    }

    public function offerRejected(OfferStatusChangeRequest $request)
    {
        $result = $offersService = $this->offersService->offerRejected(
            $request->validated()
        );

        if ($result) {
            return ApiResponder::success($result, 'Teklif kaydı başarıyla red edildi.');
        } else {
            return ApiResponder::error("Kayıt işlemi başarısız.");
        }
    }
}
