<?php

namespace App\Entities;

class BrokerPropertyReactionEntity
{
    public int $id;
    public int $propertyId;
    public int $userId;
    public bool $isLiked;
}
