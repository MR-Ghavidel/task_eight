<?php

namespace App\Repository\General;

use App\Entities\PropertyEntity;
use App\Enums\DBTables;
use App\Enums\PropertyStatus;
use App\Repository\General\Interface\PropertyRepositoryInterface;

class PropertyRepository extends BaseRepository implements PropertyRepositoryInterface
{
    protected string $table = DBTables::PROPERTIES->value;

    public function create(array $data): int
    {
        return $this->query()->insertGetId(
            array_merge(
                $data,
                $this->createdAt(),
                $this->updatedAt()
            )
        );
    }

    public function getOneById(int $id): null|PropertyEntity
    {
        $property = $this->query()->find($id);

        if ($property === null) {
            return null;
        }

        return $this->toEntity($property);
    }

    public function getAll(int $perPage = 10, int $page = 1): array
    {
        $allProperties = $this->query()
            ->select()
            ->where('status', PropertyStatus::ACTIVE->value)
            ->paginate(perPage: $perPage, page: $page);

        $propertiesEntity = [];

        foreach ($allProperties as $property) {
            $propertiesEntity[] = $this->toEntity($property);
        }

        return $propertiesEntity;
    }

    public function updateStatus(int $id, string $status): int
    {
        return $this->query()->where('id', $id)->update(['status' => $status]);
    }

    public function toEntity(object $data): PropertyEntity
    {
        $property = new PropertyEntity();
        $property->id = $data->id;
        $property->brokerId = $data->broker_id;
        $property->title = $data->title;
        $property->description = $data->description;
        $property->status = $data->status;
        $property->area = $data->area;
        $property->price = $data->price;
        $property->saleType = $data->sale_type;
        $property->type = $data->type;
        $property->city = $data->city;
        $property->street = $data->street;
        $property->latitude = $data->latitude;
        $property->longitude = $data->longitude;
        $property->floor = $data->floor;
        $property->totalFloors = $data->total_floors;

        return $property;
    }
}
