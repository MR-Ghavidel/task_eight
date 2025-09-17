<?php

namespace App\Repository\General\Interface;

interface BrokerRepositoryInterface
{
    public function create(array $data): int;
}
