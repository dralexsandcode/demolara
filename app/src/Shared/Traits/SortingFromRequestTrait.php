<?php

declare(strict_types=1);


namespace App\src\Shared\Traits;

use Illuminate\Http\Request;

trait SortingFromRequestTrait
{
    public function getSortingFromRequest(Request $request): array
    {
        $sort = [];

        if (!$request->has('sort')) {
            return $sort;
        }

        $requestSort = explode(',', $request->get('sort'));

        foreach ($requestSort as $sorting) {
            $direction = str_starts_with($sorting, '-') ? 'desc' : 'asc';
            $sorting = str_replace('-', '', $sorting);
            $sort[$sorting] = $direction;
        }

        return $sort;
    }
}