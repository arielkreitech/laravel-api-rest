<?php

namespace App\Criteria\Contracts;

interface CriteriaInterface
{
    public function withCriteria(...$criteria);
}
