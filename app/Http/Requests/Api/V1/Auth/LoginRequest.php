<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Responses\ApiResponder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [    
            'email'    => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'E-posta zorunludur',
            'email.email'    => 'Geçerli bir e-posta giriniz',
            'password.required' => 'Şifre zorunludur',
        ];
    }

    protected function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(
            ApiResponder::error(
                'Doğrulama hatası',
                200,
                $validator->errors()
            )
        );
    }

}
