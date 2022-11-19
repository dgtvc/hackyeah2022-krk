<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface LocationRepositoryInterface
{
    public function fetch(array $parameters): Collection;

    public function store(array $data): void;
}
