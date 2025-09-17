<?php

namespace App\Repository\Tenant\Interface;

interface BrokerReactionRepositoryInterface
{
    public function createSchemaByBrokerId(int $brokerId): void;
}
