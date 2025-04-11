<?php

namespace App\src\Shared\Requests;

use App\src\Shared\Exceptions\ApiException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BaseApiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * @param $validator
     * @throws ApiException
     */
    public function failedValidation($validator): void
    {
        $errors = $validator->errors()->all();

        throw new ApiException(implode(', ', $errors), 422);
    }
}
