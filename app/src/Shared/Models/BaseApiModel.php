<?php

declare(strict_types=1);


namespace App\src\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseApiModel extends Model
{
    use HasFactory;

    protected $guarded = [];
}