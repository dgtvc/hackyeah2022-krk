<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

final class LocationRepository extends AbstractEloquentRepository implements LocationRepositoryInterface
{
    protected function model(): string
    {
        return Location::class;
    }

    /**
     * @param array $parameters
     * @return Collection
     */
    public function fetch(array $parameters): Collection
    {
        return $this->with('categories')->all();
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        $this->create($data);
    }
}
