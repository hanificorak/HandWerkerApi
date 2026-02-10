<?php

namespace App\Http\Requests\Api\V1\Jobs;

use App\Http\Responses\ApiResponder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class JobsListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status'       => ['nullable', 'integer'],
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
