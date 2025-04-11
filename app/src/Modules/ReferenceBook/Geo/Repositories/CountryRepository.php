<?php

declare(strict_types=1);


namespace App\src\Modules\ReferenceBook\Geo\Repositories;

use App\src\Modules\ReferenceBook\Geo\Http\Requests\StoreCountryRequest;
use App\src\Modules\ReferenceBook\Geo\Http\Requests\UpdateCountryRequest;
use App\src\Modules\ReferenceBook\Geo\Models\Country;
use App\src\Shared\Repositories\BaseCrudRepository;
use App\src\Shared\Repositories\Contracts\BaseCrudRepositoryInterface;
use Illuminate\Support\Str;

class CountryRepository extends BaseCrudRepository implements BaseCrudRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(
            new Country(),
            new StoreCountryRequest(),
            new UpdateCountryRequest(),
        );
    }

    public function onCreatedReBuildMapModelData(array $validated): array
    {
        $lastId = $this->model::query()->max('id') + 1;

        $validated['id'] = $lastId;
        $validated['uuid'] = Str::uuid()->toString();

        return $validated;
    }

}