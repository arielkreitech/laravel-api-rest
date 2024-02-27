<?php

namespace App\Repositories;

use App\Repositories\Contracts\FactoryRepositoryInterface;
use App\Repositories\Contracts\{
    UserRepositoryInterface,
};
use App\Repositories\Eloquent\{
    EloquentUserRepository,
};

class FactoryRepository implements FactoryRepositoryInterface
{
    public function getUserRepository(): UserRepositoryInterface
    {
        return new EloquentUserRepository();
    }
}
