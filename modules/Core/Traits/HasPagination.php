<?php

namespace Modules\Core\Traits;

use Modules\Core\Models\Model;
use Illuminate\Support\Collection;
use Laravel\Scout\Builder as ScoutBuilder;
use Modules\Core\Http\Requests\IndexSkeletonRequest;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

trait HasPagination
{
    /**
     * @param  QueryBuilder|EloquentBuilder<covariant Model>|ScoutBuilder<covariant Model>  $builder
     */
    protected function sortAndOrder(QueryBuilder|EloquentBuilder|ScoutBuilder $builder, IndexSkeletonRequest $request): void
    {
        if ($request->sort_by) {
            $builder->orderBy(
                column: $request->sort_by,
                direction: $request->sort_order ?? 'asc'
            );
        } elseif ($request->sort_order) {
            $builder->orderBy(
                column: 'id',
                direction: $request->sort_order
            );
        }
    }

    /**
     * @param  QueryBuilder|EloquentBuilder<covariant Model>|ScoutBuilder<covariant Model>  $builder
     * @return LengthAwarePaginator<int, covariant Model>|Collection<int, covariant Model>
     */
    protected function allOrPaginated(QueryBuilder|EloquentBuilder|ScoutBuilder $builder, IndexSkeletonRequest $request): LengthAwarePaginator|Collection
    {
        if ($request->list_all) {
            return $builder->get();
        }

        return $builder->paginate($request->per_page ?? 12);
    }

    /**
     * @param  QueryBuilder|EloquentBuilder<covariant Model>  $builder
     * @return LengthAwarePaginator<int, covariant Model>|Collection<int, covariant Model>
     */
    protected function sortAndPaginate(QueryBuilder|EloquentBuilder $builder, IndexSkeletonRequest $request): Collection|LengthAwarePaginator
    {
        $this->sortAndPaginate($builder, $request);

        return $this->allOrPaginated($builder, $request);
    }

    /**
     * @param  QueryBuilder|EloquentBuilder<covariant Model>  $builder
     * @param  class-string<Model>  $modelClass
     */
    protected function applySearchQuery(
        QueryBuilder|EloquentBuilder $builder,
        ?string $search,
        string $modelClass,
        string $idColumn = 'id',
    ): void {
        if ($search === null || trim($search) === '') {
            return;
        }

        $ids = $modelClass::search($search)->keys();

        if ($ids->isEmpty()) {
            $builder->whereRaw('1 = 0');

            return;
        }

        $builder->whereIn($idColumn, $ids->all());
    }
}
