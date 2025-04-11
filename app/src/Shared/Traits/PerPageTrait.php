<?php

declare(strict_types=1);


namespace App\src\Shared\Traits;

use Illuminate\Http\Request;

trait PerPageTrait
{
    public function perPage(Request $request): int
    {
        $perPage = (getenv('PER_PAGE_DEFAULT') && is_numeric(getenv('PER_PAGE_DEFAULT')))
            ? getenv('PER_PAGE_DEFAULT')
            : 10;

        if ($request->has('per_page') && is_numeric($request->get('per_page'))) {
            $perPage = $request->get('per_page');
        }

        return (int)$perPage;
    }
}