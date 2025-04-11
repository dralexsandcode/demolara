<?php

namespace App\src\Modules\ReferenceBook\Geo\Http\Requests;

use App\src\Modules\ReferenceBook\Geo\Models\Country;
use App\src\Modules\ReferenceBook\Geo\Models\Region;
use App\src\Shared\Requests\BaseApiRequest;
use App\src\Shared\Validates\Rules\RulesHelper;
use Illuminate\Validation\Rule;

class UpdateRegionRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'country_id' => array_merge(
                RulesHelper::INTEGER,
                [Rule::exists(Country::class, 'id')]
            ),
            'name' => array_merge(
                RulesHelper::STRING_MAX_255,
                [Rule::unique(Region::class, 'name')]
            ),
            'latitude' => RulesHelper::STRING_MAX_50,
            'longitude' => RulesHelper::STRING_MAX_50,
        ];
    }
}
