<?php

namespace App\Entities;

class PropertyEntity
{
    public int $id;
    public int|null $brokerId;
    public string $title;
    public string $description;
    public string $status;
    public int $area;
    public int $price;
    public string $saleType;
    public string $type;
    public string $city;
    public string $street;
    public float $latitude;
    public float $longitude;
    public int $floor;
    public int $totalFloors;

    public array $features = [];
}
