<?php

namespace App\src\Modules\ReferenceBook\Geo\Http\Requests;

use App\src\Modules\ReferenceBook\Geo\Models\Country;
use App\src\Modules\ReferenceBook\Geo\Models\Region;
use App\src\Shared\Requests\BaseApiRequest;
use App\src\Shared\Validates\Rules\RulesHelper;
use Illuminate\Validation\Rule;

class StoreRegionRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'country_id' => array_merge(
                RulesHelper::REQUIRED_INTEGER,
                [Rule::exists(Country::class, 'id')]
            ),
            'name' => array_merge(
                RulesHelper::REQUIRED_STRING_MAX_255,
                [Rule::unique(Region::class, 'name')]
            ),
            'latitude' => RulesHelper::STRING_MAX_50,
            'longitude' => RulesHelper::STRING_MAX_50,
        ];
    }
}
