<?php

namespace Briofy\Tag\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ITagRepository
{
    public function list(): LengthAwarePaginator;

    public function single(string|int $value, string $column = 'id'): Model;

    public function store(string $name, array $taggable = []): Model;
}
