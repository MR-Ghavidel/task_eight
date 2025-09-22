<?php

namespace App\Repository\General;

use App\Enums\DBTables;
use App\Repository\General\Interface\PropertyFeatureRepositoryInterface;

class PropertyFeatureRepository extends BaseRepository implements PropertyFeatureRepositoryInterface
{
    protected string $table = DBTables::PROPERTY_FEATURES->value;

    public function create(array $data): bool
    {
        return $this->query()->insert($data);
    }


    public function getByPropertyId(int $propertyId): array
    {
        return $this->query()
            ->select(['name'])
            ->where('property_id', $propertyId)
            ->get()
            ->toArray();
    }
}
