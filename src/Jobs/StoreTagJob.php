<?php

namespace Briofy\Tag\Jobs;

use Briofy\Tag\Repositories\ITagRepository;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreTagJob
{
    use Dispatchable, SerializesModels;

    public function __construct(private string $name, private array $taggable = []) {

    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handle(ITagRepository $tagRepository)
    {
        return $tagRepository->store($this->name, $this->taggable);
    }
}