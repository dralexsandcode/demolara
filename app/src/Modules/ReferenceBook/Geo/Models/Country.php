<?php

namespace App\src\Modules\ReferenceBook\Geo\Models;

use App\src\Shared\Models\BaseApiModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends BaseApiModel
{
    protected $table = 'countries';
    public $timestamps = false;

    public function regions(): HasMany
    {
        return $this->hasMany(Region::class);
    }
}
