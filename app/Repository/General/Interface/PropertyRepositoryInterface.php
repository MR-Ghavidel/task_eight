<?php

namespace App\Repository\General\Interface;

use App\Entities\PropertyEntity;

interface PropertyRepositoryInterface
{
    public function create(array $data): int;

    public function getOneById(int $id): null|PropertyEntity;

    public function getAll(int $perPage, int $page): array;

    public function updateStatus(int $id, string $status): int;

    public function toEntity(object $data): PropertyEntity;
}
