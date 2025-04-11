<?php

namespace App\src\Modules\ReferenceBook\Geo\Models;

use App\src\Shared\Models\BaseApiModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Region extends BaseApiModel
{
    protected $table = 'regions';
    public $timestamps = false;

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
