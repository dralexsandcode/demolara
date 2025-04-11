<?php

declare(strict_types=1);


namespace App\src\Modules\ReferenceBook\Geo\Http\Controllers;

use App\src\Modules\ReferenceBook\Geo\Repositories\RegionRepository;
use App\src\Modules\ReferenceBook\Geo\Resources\RegionResource;
use App\src\Shared\Http\Controllers\BaseApiController;

class RegionController extends BaseApiController
{
    public function __construct()
    {
        parent::__construct(
            new RegionRepository(),
            new RegionResource(\request()),
        );
    }
}