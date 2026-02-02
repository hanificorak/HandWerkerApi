<?php

namespace App\Services\Auth;

use App\Http\Responses\ApiResponder;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function login(array $data): array
    {
        $user = User::where('email', $data['email'])->first();

        if (! $user) {
            throw new HttpResponseException(
                ApiResponder::error(
                    'E-posta bulunamadı',
                    200,
                    ['E-posta bulunamadı']
                )
            );
        }

        if (! Hash::check($data['password'], $user->password)) {
            throw new HttpResponseException(
                ApiResponder::error(
                    'Şifre hatalı',
                    200,
                    ["Şifre Hatalı"]
                )
            );
        }

        $token = $user->createToken('api')->plainTextToken;

        return [
            'token' => $token,
            'user'  => $user
        ];
    }

    public function register(array $data): array
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('api')->plainTextToken;

        return [
            'token' => $token,
            'user'  => $user
        ];
    }
}
