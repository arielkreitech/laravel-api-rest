<?php

namespace App\Repositories;

use App\Contracts\IUserRepository;
use App\Models\User;

class UserRepository implements IUserRepository{

    protected $user;

    public function __construct(user $user){
        $this->user = $user;
    }

    public function all(){
        return $this->user->all();
    }

    public function create($data){
        return $this->user->create($data);
    }

    public function update($id, $data){
        return $this->user->find($id)->update($data);
    }

    public function find($id){
        return $this->user->find($id);
    }

    public function findBy($column, $att){
        /** @var User $user */
        $user = $this->user->where($column, $att)->first();
        return $user;
    }

    public function destroy($id){
        return $this->user->find($id)->delete();
    }

}
