<?php

namespace App\Repository\General\Interface;

use App\Entities\BrokerEntity;

interface BrokerRepositoryInterface
{
    public function create(array $data): int;

    public function toEntity(object $data): BrokerEntity;

    public function findById(int $id): null|BrokerEntity;
}
