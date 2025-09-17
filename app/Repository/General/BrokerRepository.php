<?php

namespace App\Repository\General;

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
}
