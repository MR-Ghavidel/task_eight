<?php

namespace App\Repository\Tenant;

use App\Entities\BrokerPropertyViewEntity;
use App\Enums\DBTables;
use App\Repository\Tenant\Interface\BrokerPropertyViewRepositoryInterface;

class BrokerPropertyViewRepository extends TenantBaseRepository implements BrokerPropertyViewRepositoryInterface
{
    protected string $suffix = '_' . DBTables::PROPERTY_VIEWS->value;

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


    public function viewCountByPropertyIdAndBrokerId(int $brokerId, int $propertyId): int
    {
        return $this->query($brokerId)
            ->where('property_id', $propertyId)
            ->select(['ip', 'user_id'])
            ->distinct()
            ->get()
            ->count();
    }

    public function getAllViewsByBrokerId(int $brokerId): array
    {
        $propertyViews = $this->query($brokerId)->select()->get()->toArray();

        $propertyViewsEntity = [];

        foreach ($propertyViews as $propertyView) {
            $propertyViewsEntity[] = $this->toEntity($propertyView);
        }

        return $propertyViewsEntity;
    }

    public function toEntity(object $data): BrokerPropertyViewEntity
    {
        $view = new BrokerPropertyViewEntity();
        $view->id = $data->id;
        $view->propertyId = $data->property_id;
        $view->userId = $data->user_id;
        $view->ip = $data->ip;
        $view->device = $data->device;
        $view->os = $data->os;
        $view->viewedAt = $data->viewed_at;

        return $view;

    }
}
