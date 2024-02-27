<?php

namespace App\Criteria\Filters;


use App\Criteria\Contracts\CriterionInterface;


class IsEnabled implements CriterionInterface
{
    protected string $column;

    public function __construct(string $column = 'enabled')
    {
        $this->column = $column;
    }

    public function apply($entity)
    {
        return $entity->where($this->column, 1);
    }
}
