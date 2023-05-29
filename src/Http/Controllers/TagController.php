<?php

namespace Briofy\Tag\Http\Controllers;

use Briofy\RestLaravel\Http\Traits\Respond;
use Briofy\Tag\Http\Resources\TagResource;
use Briofy\Tag\Repositories\ITagRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;

class TagController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
    use Respond;

    public function __construct(
        private ITagRepository $tagRepository
    ) {
    }

    public function index(): JsonResponse
    {
        return $this->respond(TagResource::collection($this->tagRepository->list()));
    }

    public function show($id): JsonResponse
    {
        try {
            return $this->respond(TagResource::make($this->tagRepository->single($id)));
        } catch (ModelNotFoundException $exception) {
            return $this->respondEntityNotFound($exception);
        }
    }
}
