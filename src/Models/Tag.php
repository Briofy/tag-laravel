<?php

namespace Briofy\Tag\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    private $uuids = false;

    public array $fillables = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection(config('briofy-tag.database.connection'));
        $this->uuids = config('briofy-tag.database.uuid', false);
        if($this->uuids){
            $this->primaryKey = 'uuid';
            $this->keyType = 'string';
            $this->incrementing = false;
            array_merge($this->fillables, ['uuid']);
        }
    }

    protected $fillable = ['name', 'slug'];

    public function mergeFillable(array $fillable)
    {
        $this->fillables = array_merge($this->fillables, $fillable);
    }

    protected $hidden = ['pivot'];

    protected static function newFactory()
    {
        return TagFactory::new();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            if(Schema::hasColumn($tag->getTable(), 'uuid')) $tag->uuid = (string) Str::orderedUuid();
            $tag->slug = self::createUniqueSlug($tag->name);
        });
    }

    protected static function createUniqueSlug($name, $maxAttempts = 10)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $attempt = 1;

        while (static::where('slug', $slug)->exists() && $attempt <= $maxAttempts) {
            $slug = $originalSlug . '-' . $attempt;
            $attempt++;
        }

        return $slug;
    }


    public function taggable(): HasMany
    {
        return $this->hasMany(Taggable::class);
    }

}