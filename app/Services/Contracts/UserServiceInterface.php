<?php

namespace App\Services\Contracts;

interface UserServiceInterface
{
    public function getAllUsers();

    public function getUserById($id);

    public function getUserByWhere($column, $data);

    public function getUserByWhereExt($conditions);

    public function getUserByWhereFirst($column, $data, $orderBy = 'id', $orderDirection = 'asc');

    public function getUserByPaginate($perPage = 10);

    public function createUser($data);

    public function updateUser($id, $data);

    public function updateBulkUser($data, $properties);

    public function deleteUser($id);

    public function getUserByWithRelationships($relations);

    public function getUserByWithRelationshipsQuery($relations);
}
