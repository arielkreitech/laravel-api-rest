<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\UserRepositoryInterface;

class EloquentUserRepository extends RepositoryAbstract implements UserRepositoryInterface {

    public function entity()
    {
        return User::class;
    }
}
