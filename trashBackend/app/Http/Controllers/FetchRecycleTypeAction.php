<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\RecycleTypeResource;
use App\Repositories\RecycleTypeRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class FetchRecycleTypeAction extends Controller
{
    private RecycleTypeRepositoryInterface $recycleTypeRepository;

    public function __construct(RecycleTypeRepositoryInterface $recycleTypeRepository)
    {
        $this->recycleTypeRepository = $recycleTypeRepository;
    }

    public function __invoke(): AnonymousResourceCollection
    {
        return RecycleTypeResource::collection($this->recycleTypeRepository->all());
    }
}
