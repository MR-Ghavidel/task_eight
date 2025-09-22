<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BrokerPropertyDetailsResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($brokerProperty) {
                return [
                    'property_id' => $brokerProperty->propertyId,
                    'title' => $brokerProperty->title,
                    'description' => $brokerProperty->description,
                    'status' => $brokerProperty->status,
                    'view_count' => $brokerProperty->viewCount,
                    'like_count' => $brokerProperty->likeCount,
                    'dislike_count' => $brokerProperty->dislikeCount
                ];
            }),
            'lastPage' => $this[0]->lastPage ?? null,
        ];
    }
}
