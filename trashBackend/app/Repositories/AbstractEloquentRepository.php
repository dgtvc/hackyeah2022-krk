<?php

namespace App\Repositories;

use App\Interfaces\ApplicationInterface;
use App\Interfaces\RepositoryInterface;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class AbstractEloquentRepository implements RepositoryInterface
{
    /**
     * The repository model.
     */
    protected Model $model;

    /**
     * The query builder.
     */
    protected Builder $query;

    /**
     * Alias for the query limit.
     */
    protected ?int $take;

    /**
     * Array of related models to eager load.
     */
    protected array $with = [];

    /**
     * Array of one or more where clause parameters.
     */
    protected array $wheres = [];

    /**
     * Array of one or more where in clause parameters.
     */
    protected array $whereIns = [];

    /**
     * Array of one or more ORDER BY column/value pairs.
     */
    protected array $orderBys = [];

    /**
     * Array of scope methods to call on the model.
     */
    protected array $scopes = [];

    /**
     * Array of one or more has clause parameters.
     */
    protected array $has = [];

    /**
     * Array of one or more where has clause parameters.
     */
    private array $whereHas = [];

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * Get all the model records in the database.
     */
    public function all(array $columns = ['*']): array|Collection
    {
        $this->newQuery()->eagerLoad();

        $models = $this->query->get($columns);

        $this->unsetClauses();

        return $models;
    }

    /**
     * Count the number of specified model records in the database.
     */
    public function count(): int
    {
        return $this->get()->count();
    }

    /**
     * Create a new model record in the database.
     */
    public function create(array $data): Model
    {
        $this->unsetClauses();

        if ($this->model->getKeyName() === 'uuid' && !isset($data['uuid'])) {
            $data['uuid'] = Str::uuid();
        }

        return $this->model->create($data);
    }

    /**
     * Create one or more new model records in the database.
     */
    public function createMultiple(array $data): Collection
    {
        $models = new Collection();

        foreach ($data as $d) {
            $models->push($this->create($d));
        }

        return $models;
    }

    /**
     * Delete one or more model records from the database.
     */
    public function delete(): mixed
    {
        $this->newQuery()->setClauses()->setScopes();

        $result = $this->query->delete();

        $this->unsetClauses();

        return $result;
    }

    /**
     * Delete the specified model record from the database.
     */
    public function deleteById(int|string $id): bool
    {
        $this->unsetClauses();

        return $this->getById($id)->delete();
    }

    /**
     * Delete multiple records.
     */
    public function deleteMultipleById(array $ids): int
    {
        return $this->model->destroy($ids);
    }

    /**
     * Get the first specified model record from the database.
     */
    public function first(array $columns = ['*']): Model
    {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $model = $this->query->firstOrFail($columns);

        $this->unsetClauses();

        return $model;
    }

    /**
     * Get all the specified model records in the database.
     */
    public function get(array $columns = ['*']): Collection|array
    {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $models = $this->query->get($columns);

        $this->unsetClauses();

        return $models;
    }

    public function getByColumn(mixed $item, string $column, array $columns = ['*']): Model|null
    {
        $this->unsetClauses();

        $this->newQuery()->eagerLoad();

        return $this->query->where($column, $item)->first($columns);
    }

    /**
     * Get the specified model record from the database.
     */
    public function getById(int|string $id, array $columns = ['*']): Model
    {
        $this->unsetClauses();

        $this->newQuery()->eagerLoad();

        return $this->query->findOrFail($id, $columns);
    }

    /**
     * Set the query limit.
     */
    public function limit(?int $limit): self
    {
        $this->take = $limit;

        return $this;
    }

    public function makeModel(): Model
    {
        $model = app()->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of " . Model::class);
        }

        return $this->model = $model;
    }

    /**
     * Specify Model class name.
     */
    abstract protected function model(): string;

    /**
     * Set an ORDER BY clause.
     */
    public function orderBy(string $column, string $direction = 'asc'): self
    {
        $this->orderBys[] = compact('column', 'direction');

        return $this;
    }

    public function paginate(
        int $limit = ApplicationInterface::PAGINATION_PER_PAGE,
        array $columns = ['*'],
        string $pageName = 'page',
        ?int $page = null
    ): LengthAwarePaginator {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $models = $this->query->paginate($limit, $columns, $pageName, $page);

        $this->unsetClauses();

        return $models;
    }

    public function paginateWithSearch(
        int $limit = ApplicationInterface::PAGINATION_PER_PAGE,
        array $columns = ['*'],
        string $pageName = 'page',
        ?string $search = null,
        ?int $page = null
    ): LengthAwarePaginator {
        $this->newQuery()->eagerLoad();

        if ($search) {
            $this->query->search($search);
        }

        $this->setClauses()->setScopes();

        $models = $this->query->paginate($limit, $columns, $pageName, $page);

        $this->unsetClauses();

        return $models;
    }

    public function search(
        string $search,
        array $columns = ['*'],
    ): Collection {
        $this->newQuery()->eagerLoad();

        $this->query->search($search);

        $this->setClauses()->setScopes();

        $models = $this->query->get($columns);

        $this->unsetClauses();

        return $models;
    }

    /**
     * Update or create new record
     */
    public function updateOrCreate(array $compare, array $values): Model
    {
        $this->newQuery()->eagerLoad();

        $this->setClauses()->setScopes();

        $model = $this->query->updateOrCreate($compare, $values);

        $this->unsetClauses();

        return $model;
    }

    /**
     * Update the specified model record in the database.
     */
    public function updateById(int|string $id, array $data, array $options = []): Model|Collection
    {
        $this->unsetClauses();

        $model = $this->getById($id);

        $model->update($data, $options);

        return $model;
    }

    /**
     * Add a simple where clause to the query.
     */
    public function where(string $column, mixed $value, string $operator = '='): self
    {
        $this->wheres[] = compact('column', 'value', 'operator');

        return $this;
    }

    /**
     * Add a simple where in clause to the query.
     */
    public function whereIn(string $column, mixed $values): self
    {
        $values = is_array($values) ? $values : [$values];

        $this->whereIns[] = compact('column', 'values');

        return $this;
    }

    /**
     * Add a simple where has clause to the query.
     */
    public function whereHas(string $column, mixed $value): self
    {
        $this->whereHas[] = compact('column', 'value');

        return $this;
    }

    /**
     * Add a simple has clause to the query.
     */
    public function has(string $relation): self
    {
        $this->has[] = $relation;

        return $this;
    }

    /**
     * Set Eloquent relationships to eager load.
     */
    public function with(mixed $relations): self
    {
        if (is_string($relations)) {
            $relations = func_get_args();
        }

        $this->with = $relations;

        return $this;
    }

    /**
     * Add relationships to the query builder to eager load.
     */
    protected function eagerLoad(): self
    {
        foreach ($this->with as $relation) {
            $this->query->with($relation);
        }

        return $this;
    }

    /**
     * Create a new instance of the model's query builder.
     */
    protected function newQuery(): self
    {
        $this->query = $this->model->newQuery();

        return $this;
    }

    /**
     * Set clauses on the query builder.
     */
    protected function setClauses(): self
    {
        $this->setDefaults();

        foreach ($this->wheres as $where) {
            $this->query->where($where['column'], $where['operator'], $where['value']);
        }

        foreach ($this->whereIns as $whereIn) {
            $this->query->whereIn($whereIn['column'], $whereIn['values']);
        }

        foreach ($this->has as $has) {
            $this->query->has($has);
        }

        foreach ($this->whereHas as $whereHas) {
            $this->query->whereHas($whereHas['column'], $whereHas['value']);
        }

        foreach ($this->orderBys as $orders) {
            $this->query->orderBy($orders['column'], $orders['direction']);
        }

        if (isset($this->take) and !is_null($this->take)) {
            $this->query->take($this->take);
        }

        return $this;
    }

    /**
     * Set query scopes.
     */
    protected function setScopes(): self
    {
        foreach ($this->scopes as $method => $args) {
            $this->query->$method(implode(', ', $args));
        }

        return $this;
    }

    /**
     * Reset the query clause parameter arrays.
     */
    protected function unsetClauses(): self
    {
        $this->wheres = [];
        $this->whereHas = [];
        $this->has = [];
        $this->whereIns = [];
        $this->scopes = [];
        $this->orderBys = [];
        $this->take = null;

        return $this;
    }

    protected function setDefaults(): void
    {
        //
    }
}
