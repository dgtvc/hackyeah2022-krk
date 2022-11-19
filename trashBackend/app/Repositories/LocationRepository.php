<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DataTransferObject\FetchQueryDto;
use App\Models\Location;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final class LocationRepository extends AbstractEloquentRepository implements LocationRepositoryInterface
{
    protected function model(): string
    {
        return Location::class;
    }

    /**
     * @param FetchQueryDto $parameters
     * @param array $area
     * @return Collection
     */
    public function fetch(FetchQueryDto $parameters, array $area): Collection
    {
        return $this
            ->ofCategoryTypes($parameters->getTrashType(), $parameters->getRecycleType())
            ->whereBetween('latitude', $area['min_latitude'], $area['max_latitude'])
            ->whereBetween('longitude', $area['min_longitude'], $area['max_longitude'])
            ->with('categories')
            ->get();
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        /** @var Location $model */
        $model = $this->makeModel();
        $model->fill($data);
        $model->save();

        $categories = array_map(function (string $uuid) use ($model){
            return [
                'category_uuid' => $uuid,
                'location_uuid' => $model->uuid,
            ];
        }, $data['category']);

        $model->categories()->sync($categories);
    }

    private function ofCategoryTypes(array $trashType, array $recycleType)
    {
        $this->whereHas('categories',
            fn(Builder $query) => $query
                ->whereIn('uuid', $trashType)
                ->where('type', 'Trash')
                ->orWhereIn('uuid', $recycleType)
                ->where('type', 'Recycle')
        );

        return $this;
    }
}
