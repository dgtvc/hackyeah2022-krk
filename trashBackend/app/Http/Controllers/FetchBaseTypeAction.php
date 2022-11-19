<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\CategoryApiResource;
use App\Http\Resources\RecycleTypeResource;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\RecycleTypeRepositoryInterface;
use Illuminate\Http\Request;

final class FetchBaseTypeAction extends Controller
{
    public function __construct(
        private RecycleTypeRepositoryInterface $recycleTypeRepository,
        private CategoryRepositoryInterface $categoryRepository
    ) {
        //
    }

    public function __invoke(Request $request): array
    {
        return [
            RecycleTypeResource::collection($this->recycleTypeRepository->all())->toArray($request),
            CategoryApiResource::collection($this->categoryRepository->all())->toArray($request),
        ];
    }
}
