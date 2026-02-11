<?php

namespace App\Http\Requests\Api\V1\Profile;

use App\Http\Responses\ApiResponder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PasswordUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required' ],
            'new_password' => ['required'],
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ApiResponder::error(
                'Doğrulama hatası',
                422,
                $validator->errors()
            )
        );
    }
}
