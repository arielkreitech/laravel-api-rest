<?php

namespace App\Repositories;


use App\Criteria\Contracts\CriteriaInterface;
use App\Exceptions\NoEntityDefined;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Support\Arr;

abstract class RepositoryAbstract implements RepositoryInterface, CriteriaInterface
{
    protected $entity;

    public function __construct()
    {
        $this->entity = $this->resolveEntity();
    }

    public function all()
    {

        return $this->entity->all();
    }

    public function find($id)
    {
        return $this->entity->find($id);
    }

    public function findWhere($column, $value)
    {
        return $this->entity->where($column, $value)->get();
    }

    public function findWhereExt($conditions)
    {
        $query = $this->entity->query();
        foreach ($conditions as $condition) {
            [$column, $operator, $value] = $condition;
            $query->where($column, $operator, $value);
        }
        return $query->get();
    }

    public function findWhereFirst($column, $value, $orderBy = 'id', $orderDirection = 'asc')
    {
        return $this->entity->where($column, $value)
            ->orderBy($orderBy, $orderDirection)
            ->first();
    }

    public function paginate($perPage = 10)
    {
        return $this->entity->paginate($perPage);
    }

    public function create(array $properties)
    {
        return $this->entity->create($properties);
    }

    public function update($id, array $properties)
    {
        return $this->find($id)->update($properties);
    }

    public function updateBulk(array $id, array $properties)
    {
        return $this->entity->whereIn('id', $id)->update($properties);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function query()
    {
        return $this->entity->newQuery();
    }


    public function withRelationships(array $relations)
    {
        return $this->entity->with($relations)->get();
    }

    public function withRelationshipsQuery(array $relations)
    {
        return $this->entity->with($relations);
    }

    public function withCriteria(...$criteria): RepositoryAbstract
    {
        $criteria = Arr::flatten($criteria);

        foreach ($criteria as $criterion) {
            $this->entity = $criterion->apply($this->entity);
        }

        return $this;
    }

    protected function resolveEntity()
    {
        if (!method_exists($this, 'entity')) {
            throw new NoEntityDefined('No entity defined!');
        }

        return app()->make($this->entity()); // App\AnyEntity
    }
}
