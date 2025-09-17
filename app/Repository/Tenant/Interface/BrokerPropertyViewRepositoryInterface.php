<?php

namespace App\Repository\Tenant\Interface;

interface BrokerPropertyViewRepositoryInterface
{
    public function createSchemaByBrokerId(int $brokerId): void;
}
