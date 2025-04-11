<?php

namespace App\src\Modules\ReferenceBook\Geo\Http\Requests;

use App\src\Modules\ReferenceBook\Geo\Models\Country;
use App\src\Shared\Requests\BaseApiRequest;
use App\src\Shared\Validates\Rules\RulesHelper;
use Illuminate\Validation\Rule;

class StoreCountryRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => array_merge(
                RulesHelper::REQUIRED_STRING_MAX_100,
                [Rule::unique(Country::class, 'name')]
            ),
        ];
    }

}
