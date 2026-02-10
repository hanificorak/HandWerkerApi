<?php

namespace App\Http\Requests\Api\V1\Jobs;

use App\Http\Responses\ApiResponder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class JobsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['nullable', 'string', 'max:255'],

            'category'    => ['required'],
            'description' => ['required', 'string', 'min:20'],

            'photos'      => ['nullable', 'array'],

            'country'     => ['required'],
            'city'        => ['required'],
            'district'    => ['required'],
            'address'     => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'category.required'    => 'Kategori seçilmelidir',
            'description.required' => 'Açıklama zorunludur',
            'description.min'      => 'Açıklama en az 20 karakter olmalıdır',

            'country.required'     => 'Ülke seçilmelidir',
            'city.required'        => 'Şehir seçilmelidir',
            'district.required'    => 'İlçe seçilmelidir',
            'address.required'     => 'Adres zorunludur',
            'address.min'          => 'Adres çok kısa',

            'photos.array'         => 'Fotoğraflar geçersiz',
            'photos.*.image'       => 'Yüklenen dosya resim olmalıdır',
            'photos.*.mimes'       => 'Fotoğraflar jpg veya png olmalıdır',
            'photos.*.max'         => 'Fotoğraf boyutu 4MB’dan büyük olamaz',
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
