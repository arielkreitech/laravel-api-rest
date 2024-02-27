<?php

namespace App\Criteria\Contracts;


interface CriterionInterface
{
    public function apply($entity);
}
