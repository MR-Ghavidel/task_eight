<?php

namespace App\Repository\General;

use App\Entities\BrokerEntity;
use App\Enums\DBTables;
use App\Repository\General\Interface\BrokerRepositoryInterface;

class BrokerRepository extends BaseRepository implements BrokerRepositoryInterface
{
    protected string $table = DBTables::BROKERS->value;

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

    public function findById(int $id): null|BrokerEntity
    {
        $broker = $this->query()->find($id);

        if ($broker === null) {
            return null;
        }

        return $this->toEntity($broker);
    }

    public function toEntity(object $data): BrokerEntity
    {
        $broker = new BrokerEntity();
        $broker->id = $data->id;
        $broker->firstName = $data->first_name;
        $broker->lastName = $data->last_name;
        $broker->email = $data->email;
        $broker->phone = $data->phone;

        return $broker;
    }
}
