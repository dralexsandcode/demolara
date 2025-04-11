<?php

declare(strict_types=1);

use App\src\Modules\ReferenceBook\Geo\Http\Controllers\CountryController;
use App\src\Modules\ReferenceBook\Geo\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

// countries

Route::get('countries', [CountryController::class, 'index']
)
    ->name('countries.index');

Route::get('countries/{country}', [CountryController::class, 'show']
)
    ->name('countries.show');

Route::post('countries', [CountryController::class, 'store'])
    ->name('countries.store');

Route::match(['put', 'patch'],
    'countries/{country}',
    [CountryController::class, 'update'])
    ->name('countries.update');

Route::delete('countries/{country}', [CountryController::class, 'destroy'])
    ->name('countries.destroy');

// regions

Route::get('regions', [RegionController::class, 'index']
)
    ->name('regions.index');

Route::get('regions/{region}', [RegionController::class, 'show']
)
    ->name('regions.show');

Route::post('regions', [RegionController::class, 'store'])
    ->name('regions.store');

Route::match(['put', 'patch'],
    'regions/{region}',
    [RegionController::class, 'update'])
    ->name('regions.update');

Route::delete(
    'regions/{region}',
    [RegionController::class, 'destroy']
)
    ->name('regions.destroy');