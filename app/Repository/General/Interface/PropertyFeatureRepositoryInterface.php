<?php

namespace App\Repository\General\Interface;

interface PropertyFeatureRepositoryInterface
{
    public function create(array $data): bool;

    public function getByPropertyId(int $propertyId): array;

    public function getAllByIds(array $ids): array;

}
