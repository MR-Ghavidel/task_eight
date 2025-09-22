<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrokerPropertyDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'property_id' => $this->propertyId,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'view_count' => $this->viewCount,
            'like_count' => $this->likeCount,
            'dislike_count' => $this->dislikeCount
        ];
    }
}
