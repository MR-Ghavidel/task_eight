<?php

namespace App\Repository\General\Interface;

use App\Entities\UserEntity;

interface UserRepositoryInterface
{
    public function create(array $data): int;

    public function toEntity(object $data): UserEntity;

    public function findById(int $id): null|UserEntity;
}
