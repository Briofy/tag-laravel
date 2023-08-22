<?php

namespace Briofy\Tag\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    private $uuids = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->uuids = config('briofy-tag.database.uuid', false);
        if($this->uuids){
            $this->primaryKey = 'uuid';
            $this->keyType = 'string';
            $this->incrementing = false;
        }
    }

    protected $fillable = [ 'name', 'slug'];

    protected $hidden = ['pivot'];

    protected static function newFactory()
    {
        return TagFactory::new();
    }

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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            $tag->slug = Str::slug($tag->name);
        });
    }

}
