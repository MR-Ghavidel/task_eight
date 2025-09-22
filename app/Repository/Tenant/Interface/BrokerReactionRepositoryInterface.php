<?php

namespace App\Repository\Tenant\Interface;

use App\Entities\BrokerPropertyReactionEntity;

interface BrokerReactionRepositoryInterface
{
    public function createByBrokerId(array $data, int $brokerId): int;

    public function isReacted(int $propertyId, int $userId, int $brokerId): bool;

    public function likeCountByPropertyIdAndBrokerId(int $propertyId, int $brokerId): int;

    public function disLikeCountByPropertyIdAndBrokerId(int $propertyId, int $brokerId): int;

    public function toEntity(object $data): BrokerPropertyReactionEntity;

    public function getAllReactionsByBrokerId(int $brokerId): array;
}
