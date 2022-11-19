<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function all(array $columns = ['*']): array|Collection;

    public function count(): int;

    public function create(array $data): Model;

    public function createMultiple(array $data): Collection;

    public function delete(): mixed;

    public function deleteById(int|string $id): bool;

    public function deleteMultipleById(array $ids): int;

    public function first(array $columns = ['*']): Model;

    public function get(array $columns = ['*']): Collection|array;

    public function getByColumn(int $item, string $column, array $columns = ['*']): Model|null;

    public function getById(int|string $id, array $columns = ['*']): Model;

    public function limit(?int $limit): self;

    public function orderBy(string $column, string $direction): self;

    public function updateOrCreate(array $compare, array $values): Model;

    public function paginate(
        int $limit = ApplicationInterface::PAGINATION_PER_PAGE,
        array $columns = ['*'],
        string $pageName = 'page',
        ?int $page = null
    ): LengthAwarePaginator;

    public function paginateWithSearch(
        int $limit = ApplicationInterface::PAGINATION_PER_PAGE,
        array $columns = ['*'],
        string $pageName = 'page',
        ?string $search = null,
        ?int $page = null
    ): LengthAwarePaginator;

    public function search(
        string $search,
        array $columns = ['*'],
    ): Collection;

    public function updateById(int|string $id, array $data, array $options = []): Model|Collection;

    public function where(string $column, mixed $value, string $operator = '='): self;

    public function whereIn(string $column, mixed $value): self;

    public function with(mixed $relations): self;
}
