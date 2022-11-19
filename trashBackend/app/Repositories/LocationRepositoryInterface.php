<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DataTransferObject\FetchQueryDto;
use Illuminate\Database\Eloquent\Collection;

interface LocationRepositoryInterface
{
    public function fetch(FetchQueryDto $parameters): Collection;

    public function store(array $data): void;
}
