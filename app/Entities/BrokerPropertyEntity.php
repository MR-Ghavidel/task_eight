<?php

namespace App\Entities;

class BrokerPropertyEntity
{
    public int $id;
    public int $propertyId;
    public string $title;
    public string $description;
    public string $status;

    public int|null $viewCount;
    public int|null $likeCount;
    public int|null $dislikeCount;

}
