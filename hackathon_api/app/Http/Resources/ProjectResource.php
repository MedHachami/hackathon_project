<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "link" => $this->link,
            "isRated" => $this->is_rated,
            "media" => MediaResource::collection($this->media),
            "category" => new CategoryResource($this->category),
        ];
    }
}
