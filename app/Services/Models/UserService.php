<?php

namespace App\Services\Models;

use App\Repositories\Contracts\FactoryRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
    protected $factoryRepository;

    public function __construct(FactoryRepositoryInterface $factoryRepository)
    {
        $this->factoryRepository = $factoryRepository;
    }

    public function getAllUsers()
    {
        return $this->factoryRepository->getUserRepository()->all();
    }

    public function getUserById($id)
    {
        return $this->factoryRepository->getUserRepository()->find($id);
    }

    public function getUserByWhere($column, $att)
    {
        return $this->factoryRepository->getUserRepository()->findWhere($column, $att);
    }

    public function getUserByWhereExt($conditions)
    {
        return $this->factoryRepository->getUserRepository()->findWhereExt($conditions);
    }

    public function getUserByWhereFirst($column, $att, $orderBy = 'id', $orderDirection = 'asc')
    {
        return $this->factoryRepository->getUserRepository()->findWhereFirst($column, $att, $orderBy, $orderDirection);
    }

    public function getUserByPaginate($perPage = 10)
    {
        return $this->factoryRepository->getUserRepository()->paginate($perPage);
    }

    public function createUser($data)
    {
        return $this->factoryRepository->getUserRepository()->create($data);
    }

    public function updateUser($id, $data)
    {
        return $this->factoryRepository->getUserRepository()->update($id, $data);
    }

    public function updateBulkUser($data, $properties)
    {
        return $this->factoryRepository->getUserRepository()->updateBulk($data,$properties);
    }

    public function deleteUser($id)
    {
        return $this->factoryRepository->getUserRepository()->delete($id);
    }

    public function getUserByWithRelationships($relations)
    {
        return $this->factoryRepository->getUserRepository()->withRelationships($relations);
    }

    public function getUserByWithRelationshipsQuery($relations)
    {
        return $this->factoryRepository->getUserRepository()->withRelationshipsQuery($relations);
    }

}
