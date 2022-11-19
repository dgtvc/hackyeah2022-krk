<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DataTransferObject\FetchQueryDto;
use App\Models\Location;
use App\Models\RecycleType;
use Exception;
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
        if ($parameters->getTrashType()) {
            $this->ofCategoryTypes($parameters->getTrashType());
        }

        if ($parameters->getRecycleType()) {
            $this->whereIn(RecycleType::RELATION_STRING, $parameters->getRecycleType());
        }

        return $this->whereBetween('latitude', $area['min_latitude'], $area['max_latitude'])
            ->whereBetween('longitude', $area['min_longitude'], $area['max_longitude'])
            ->with('categories')
            ->get();
    }

    /**
     * @param  array  $data
     * @return void
     * @throws Exception
     */
    public function store(array $data): void
    {
        /** @var Location $model */
        $model = $this->makeModel();
        $model->fill($data);
        $model->save();

        $categories = array_map(function (string $uuid) use ($model) {
            return [
                'category_uuid' => $uuid,
                'location_uuid' => $model->uuid,
            ];
        }, $data['category']);

        $model->categories()->sync($categories);
    }

    private function ofCategoryTypes(array $trashType): self
    {
        $this->whereHas(
            'categories',
            fn (Builder $query) => $query
                ->whereIn('uuid', $trashType)
        );

        return $this;
    }
}
