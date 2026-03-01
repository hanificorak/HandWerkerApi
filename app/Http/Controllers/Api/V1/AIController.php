<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\ApprovedRequest;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Requests\Api\V1\Profile\JobPriceCheckRequest;
use App\Http\Responses\ApiResponder;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\specialization;
use App\Services\AI\AiService;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AIController extends Controller
{
    public function __construct(
        protected AiService $aiService
    ) {}

    public function jobPriceCheck(JobPriceCheckRequest $request)
    {

        $data = $request->validated();
        $country_name = Countries::find($data['country_id'])->name;
        $city_name = Cities::find($data['city_id'])->name;
        $category_name = specialization::find($data['category_id'])->translation->title;


        $result = $aiService = $this->aiService->sendGemini($country_name, $city_name, $category_name, $data['message']);
        
        return ApiResponder::success($result, 'İşlem başarılı');
    }
}
