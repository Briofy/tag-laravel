<?php

namespace Briofy\Tag\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
        ];
    }
}
