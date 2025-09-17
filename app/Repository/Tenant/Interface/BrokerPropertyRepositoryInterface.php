<?php

namespace App\Repository\Tenant\Interface;

interface BrokerPropertyRepositoryInterface
{
    public function createSchemaByBrokerId(int $brokerId): void;
}
