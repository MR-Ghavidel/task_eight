<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowPropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'broker_id' => $this->brokerId,
            'title' => $this->title,
            'description' => $this->description,
            'area' => $this->area,
            'price' => number_format($this->price),
            'sale_type' => 'for ' . $this->saleType,
            'type' => $this->type,
            'city' => $this->city,
            'street' => $this->street,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'floor' => $this->floor,
            'total_floors' => $this->totalFloors,
            'features' => collect($this->features)->map(function ($feature) {
                return $feature->name ?? '';
            })

        ];
    }
}
