<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\FetchLocationRequest;
use App\Http\Resources\LocationApiResource;
use App\Repositories\LocationRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class FetchLocationAction extends Controller
{
    private LocationRepositoryInterface $locationRepository;

    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function __invoke(FetchLocationRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();

        $locationCollection = $this->locationRepository->fetch($data);

        return LocationApiResource::collection($locationCollection);
    }
}
