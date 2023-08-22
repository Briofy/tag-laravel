<?php

namespace Briofy\Tag\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $fillable = [ 'title', 'slug'];

    protected $hidden = ['pivot'];

    protected static function newFactory()
    {
        return TagFactory::new();
    }
}
