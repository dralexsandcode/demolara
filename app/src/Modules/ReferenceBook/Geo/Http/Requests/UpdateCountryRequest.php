<?php

namespace App\src\Modules\ReferenceBook\Geo\Http\Requests;

use App\src\Modules\ReferenceBook\Geo\Models\Country;
use App\src\Shared\Requests\BaseApiRequest;
use App\src\Shared\Validates\Rules\RulesHelper;
use Illuminate\Validation\Rule;

class UpdateCountryRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => array_merge(
                RulesHelper::STRING_MAX_100,
                [Rule::unique(Country::class, 'name')]
            ),
        ];
    }
}
