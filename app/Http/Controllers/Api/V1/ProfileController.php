<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Profile\PasswordUpdateRequest;
use App\Http\Requests\Api\V1\Profile\ProfileUpdateRequest;
use App\Http\Responses\ApiResponder;
use App\Services\Param\ParamService;
use App\Services\Profile\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(
        protected ProfileService $profileService
    ) {}
   
    public function getUserInfo()
    {
        $result = $profileService = $this->profileService->getUserInfo();

        return ApiResponder::success($result, 'User Ok');
    }

    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $result = $profileService = $this->profileService->profileUpdate(
            $request->validated()
        );

        if ($result) {
            return ApiResponder::success($result, 'Kayıt başarıyla tamamlandı.');
        } else {
            return ApiResponder::error("Kayıt işlemi başarısız.");
        }
    }


    public function passwordUpdate(PasswordUpdateRequest $request)
    {
        $result = $profileService = $this->profileService->passwordUpdate(
            $request->validated()
        );

        if ($result["status"]) {
            return ApiResponder::success($result, 'Şifreniz başarıyla güncellendi..');
        } else {
            return ApiResponder::error($result["message"]);
        }
    }


}
