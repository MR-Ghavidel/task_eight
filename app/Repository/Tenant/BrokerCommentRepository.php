<?php

namespace App\Repository\Tenant;

use App\Enums\DBTables;
use App\Repository\Tenant\Interface\BrokerCommentRepositoryInterface;

class BrokerCommentRepository extends TenantBaseRepository implements BrokerCommentRepositoryInterface
{
    protected string $suffix = '_' . DBTables::COMMENTS->value;

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
}
