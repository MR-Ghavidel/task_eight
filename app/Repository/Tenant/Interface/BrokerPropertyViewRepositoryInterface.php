<?php

namespace App\Repository\Tenant\Interface;

use App\Entities\BrokerPropertyViewEntity;

interface BrokerPropertyViewRepositoryInterface
{
    public function createByBrokerId(array $data, int $brokerId): int;

    public function viewCountByPropertyIdAndBrokerId(int $brokerId, int $propertyId): int;

    public function getAllViewsByBrokerId(int $brokerId): array;

    public function toEntity(object $data): BrokerPropertyViewEntity;
}
