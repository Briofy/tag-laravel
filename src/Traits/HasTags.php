<?php

namespace Briofy\Tag\Traits;

use Briofy\Tag\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTags
{
    public function tags(): MorphToMany
    {
        $privateKey = config('briofy-tag.database.uuid', false) ? 'uuid' : 'id';
        $privateKey = 'tag_'.$privateKey;
        return $this->morphToMany(Tag::class, 'taggable', relatedPivotKey: $privateKey);
    }
}
