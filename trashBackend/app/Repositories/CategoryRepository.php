<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Category;

final class CategoryRepository extends AbstractEloquentRepository implements CategoryRepositoryInterface
{
    protected function model(): string
    {
        return Category::class;
    }
}
