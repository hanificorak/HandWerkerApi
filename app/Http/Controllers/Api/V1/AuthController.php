<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\ApprovedRequest;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Responses\ApiResponder;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    public function login(LoginRequest $request)
    {
        $result = $authService = $this->authService->login(
            $request->validated()
        );

        return ApiResponder::success($result, 'Giriş başarılı');
    }

    public function register(RegisterRequest $request)
    {
        $result = $this->authService->register(
            $request->validated()
        );

        return ApiResponder::success($result, 'Kayıt başarılı', 200);
    }

    public function approvedUser(ApprovedRequest $request)
    {
        $result = $this->authService->userApproved(
            $request->validated()
        );

        return ApiResponder::success($result, 'Doğrulama işlemi başarıyla gerçekleşti.', 200);
    }

    public function me(Request $request)
    {
        return ApiResponder::success($request->user());
    }
}
