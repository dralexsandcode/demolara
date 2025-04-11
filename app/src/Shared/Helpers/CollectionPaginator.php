<?php

declare(strict_types=1);


namespace App\src\Shared\Helpers;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CollectionPaginator
{
    public function __construct(
        protected Collection $collection,
        protected int $perPage,
    ) {
    }

    public function toPaginate(): LengthAwarePaginator
    {
        $page = LengthAwarePaginator::resolveCurrentPage('page');

        //$links = $responsePaginated->links();

        return new LengthAwarePaginator(
            $this->collection->forPage($page, $this->perPage),
            $this->collection->count(),
            $this->perPage,
            $page, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => request()->query(),
            ]
        );
    }
}