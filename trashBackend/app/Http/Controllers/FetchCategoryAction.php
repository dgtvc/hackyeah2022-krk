<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\CategoryApiResource;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class FetchCategoryAction extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function __invoke(): AnonymousResourceCollection
    {
        return CategoryApiResource::collection($this->categoryRepository->all());
    }
}
