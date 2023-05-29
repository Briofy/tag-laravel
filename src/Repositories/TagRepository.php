<?php

namespace Briofy\Tag\Repositories;

use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Briofy\Tag\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class TagRepository extends AbstractRepository implements ITagRepository
{
    public function list(): LengthAwarePaginator
    {
        return $this->model->paginate();
    }

    public function single(string|int $value, string $column = 'id'): Model
    {
        return $this->model->where($column, $value)->firstOrFail();
    }

    protected function instance(array $attributes = []): Model
    {
        return new Tag();
    }
}
