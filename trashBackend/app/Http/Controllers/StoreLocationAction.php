<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Repositories\LocationRepositoryInterface;
use Illuminate\Http\Response;

final class StoreLocationAction extends Controller
{
    private LocationRepositoryInterface $locationRepository;

    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function __invoke(StoreLocationRequest $request)
    {
        $data = $request->validated();

        $this->locationRepository->store($data);

        return new Response('', Response::HTTP_CREATED);
    }
}
