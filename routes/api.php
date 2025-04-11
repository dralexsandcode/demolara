<?php

declare(strict_types=1);


use Illuminate\Support\Facades\Route;

Route::name('api.')
    ->group(base_path('routes/api/v1/guest/routes.php'));