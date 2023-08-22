<?php

namespace Briofy\Tag\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Taggable extends Model
{
    use SoftDeletes;

    private bool $uuids, $taggableUuids = false;
    private string $fillablesTagId = 'tag_id';
    private string $fillablesTaggableId = 'taggable_id';
    public array $fillables = ['taggable_type'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection(config('briofy-tag.database.connection'));
        $this->uuids = config('briofy-tag.database.uuid', false);
        $this->taggableUuids = config('briofy-tag.database.taggable_uuid', false);
        if($this->taggableUuids){
            $this->primaryKey = 'uuid';
            $this->keyType = 'string';
            $this->incrementing = false;
            $this->fillablesTaggableId = 'taggable_uuid';
        }
        if($this->uuids) $this->fillablesTagId = 'tag_uuid';
        $this->fillables = array_merge($this->fillables, [$this->fillablesTagId, $this->fillablesTaggableId]);
    }

    /**
     * @param string[] $fillable
     */
    public function setFillable(array $fillable): void
    {
        $this->fillable = $this->fillables;
    }
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

}
