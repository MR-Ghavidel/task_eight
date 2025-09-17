<?php

namespace App\Repository\Tenant\Interface;

interface BrokerCommentRepositoryInterface
{
    public function createSchemaByBrokerId(int $brokerId): void;
}
