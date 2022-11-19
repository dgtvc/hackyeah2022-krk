<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\RecycleType;

final class RecycleTypeRepository extends AbstractEloquentRepository implements RecycleTypeRepositoryInterface
{
    protected function model(): string
    {
        return RecycleType::class;
    }
}
