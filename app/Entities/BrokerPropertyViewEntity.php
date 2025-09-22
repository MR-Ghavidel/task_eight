<?php

namespace App\Entities;

class BrokerPropertyViewEntity
{
    public int $id;
    public int $propertyId;
    public int $userId;
    public string $ip;
    public string $device;
    public string $os;
    public string $viewedAt;
}
