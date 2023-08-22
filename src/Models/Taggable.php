<?php

namespace Briofy\Tag\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Taggable extends Model
{
    use SoftDeletes;

    private $uuids = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection(config('briofy-tag.database.connection'));
        $this->uuids = config('briofy-tag.database.taggable_uuid', false);
        if($this->uuids){
            $this->primaryKey = 'uuid';
            $this->keyType = 'string';
            $this->incrementing = false;
        }
    }

    protected $fillable = [ 'tag_id', 'taggable_id', 'taggable_type'];

    protected function initializeTraits()
    {
        parent::initializeTraits();
        if($this->uuids){
            $this->bootHasUuids();
        }
    }

    protected static function bootHasUuids()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::orderedUuid();
            }
        });
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

}
