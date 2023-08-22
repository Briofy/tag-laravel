<?php

namespace Briofy\Tag\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray($request): array
    {
        $IdType = config('briofy-tag.database.uuid') ? 'uuid' : 'id';
        return [
            $IdType => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }
}
