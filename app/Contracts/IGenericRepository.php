<?php

namespace App\Contracts;

interface IGenericRepository {

    public function all();

    public function create($data);

    public function update($id, $data);

    public function find($id);

    public function findBy($column, $att);

    public function destroy($id);

}
