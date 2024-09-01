<?php

namespace Tests\SupportTraits;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;

trait MocksPaginatedBuilder
{

    /**
     * Mocks the paginate method on a given query builder.
     *
     * @param mixed $mockBuilder The query builder to mock.
     * @param \Illuminate\Support\Collection $items The collection of items to paginate.
     * @param int $perPage The number of items per page.
     * @param int $currentPage The current page number.
     * @return void
     */
    public function mockPaginate(mixed $mockBuilder, $items, $perPage = 10, $currentPage = 1)
    {
        $paginatedItems = new LengthAwarePaginator(
            $items,
            $items->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );

        $mockBuilder->shouldReceive('paginate')->andReturn($paginatedItems);
    }
}
