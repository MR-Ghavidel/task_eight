<?php

namespace App\Repository\Tenant;

use App\Entities\BrokerPropertyReactionEntity;
use App\Enums\DBTables;
use App\Repository\Tenant\Interface\BrokerReactionRepositoryInterface;

class BrokerReactionRepository extends TenantBaseRepository implements BrokerReactionRepositoryInterface
{
    protected string $suffix = '_' . DBTables::REACTIONS->value;

    public function createByBrokerId(array $data, int $brokerId): int
    {
        return $this->query($brokerId)->insertGetId(
            array_merge(
                $data,
                $this->createdAt(),
                $this->updatedAt()
            )
        );
    }

    public function isReacted(int $propertyId, int $userId, int $brokerId): bool
    {
        return $this->query($brokerId)
            ->where('user_id', $userId)
            ->where('property_id', $propertyId)
            ->exists();
    }

    public function likeCountByPropertyIdAndBrokerId(int $propertyId, int $brokerId): int
    {
        return $this->query($brokerId)
            ->where('property_id', $propertyId)
            ->where('is_liked', true)
            ->get()
            ->count();
    }

    public function disLikeCountByPropertyIdAndBrokerId(int $propertyId, int $brokerId): int
    {
        return $this->query($brokerId)
            ->where('property_id', $propertyId)
            ->where('is_liked', false)
            ->get()
            ->count();
    }

    public function getAllReactionsByBrokerId(int $brokerId): array
    {
        $propertyReactions = $this->query($brokerId)->select()->get()->toArray();

        $propertyReactionsEntity = [];

        foreach ($propertyReactions as $propertyView) {
            $propertyReactionsEntity[] = $this->toEntity($propertyView);
        }

        return $propertyReactionsEntity;
    }

    public function toEntity(object $data): BrokerPropertyReactionEntity
    {
        $reaction = new BrokerPropertyReactionEntity();

        $reaction->id = $data->id;
        $reaction->propertyId = $data->property_id;
        $reaction->userId = $data->user_id;
        $reaction->isLiked = $data->is_liked;

        return $reaction;
    }
}
