<?php

namespace App\Repository\Tenant;

use App\Entities\BrokerPropertyEntity;
use App\Enums\DBTables;
use App\Repository\Tenant\Interface\BrokerPropertyRepositoryInterface;

class BrokerPropertyRepository extends TenantBaseRepository implements BrokerPropertyRepositoryInterface
{
    protected string $suffix = '_' . DBTables::PROPERTIES->value;


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

    public function getOneById(int $propertyId, int $brokerId): null|BrokerPropertyEntity
    {
        $property = $this->query($brokerId)->where('property_id', $propertyId)->firstOrFail();

        if ($property === null) {
            return null;
        }

        return $this->toEntity($property);
    }

    public function toEntity(object $data): BrokerPropertyEntity
    {
        $property = new BrokerPropertyEntity();
        $property->id = $data->id;
        $property->propertyId = $data->property_id;
        $property->title = $data->property_title;
        $property->description = $data->property_description;
        $property->status = $data->status;

        return $property;
    }

    public function getAllPropertiesByBrokerId(int $brokerId, int $perPage, int $page): array
    {
        $properties = $this->query($brokerId)->select()->paginate(perPage: $perPage, page: $page);

        $propertiesEntity = [];

        foreach ($properties as $property) {
            $propertiesEntity[] = $this->toEntity($property);
        }

        return $propertiesEntity;
    }

    public function updateStatus(int $brokerId, int $propertyId, string $status): int
    {
        return $this->query($brokerId)->where('property_id', $propertyId)->update(['status' => $status]);
    }
}
