<?php

namespace App\Repository\Tenant\Interface;

use App\Entities\BrokerPropertyEntity;

interface BrokerPropertyRepositoryInterface
{
    public function createByBrokerId(array $data, int $brokerId): int;

    public function getOneById(int $propertyId, int $brokerId): null|BrokerPropertyEntity;

    public function getAllPropertiesByBrokerId(int $brokerId, int $perPage, int $page): array;

    public function toEntity(object $data): BrokerPropertyEntity;

    public function updateStatus(int $brokerId, int $propertyId, string $status): int;
}
