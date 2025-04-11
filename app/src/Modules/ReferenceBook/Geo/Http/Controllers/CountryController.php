<?php

declare(strict_types=1);


namespace App\src\Modules\ReferenceBook\Geo\Http\Controllers;

use App\src\Modules\ReferenceBook\Geo\Repositories\CountryRepository;
use App\src\Modules\ReferenceBook\Geo\Resources\CountryResource;
use App\src\Shared\Http\Controllers\BaseApiController;

class CountryController extends BaseApiController
{
    public function __construct()
    {
        parent::__construct(
            new CountryRepository(),
            new CountryResource(\request()),
        );
    }
}