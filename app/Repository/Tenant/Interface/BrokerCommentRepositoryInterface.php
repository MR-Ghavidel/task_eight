<?php

namespace App\Repository\Tenant\Interface;

interface BrokerCommentRepositoryInterface
{
    public function createByBrokerId(array $data, int $brokerId): int;
}
