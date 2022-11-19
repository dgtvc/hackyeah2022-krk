<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\FetchLocationRequest;
use App\Http\Resources\LocationApiResource;
use App\Interfaces\GeoCalculationServiceInterface;
use App\Repositories\LocationRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class FetchLocationAction extends Controller
{
    private LocationRepositoryInterface $locationRepository;
    private GeoCalculationServiceInterface $geoCalculationService;

    public function __construct(
        LocationRepositoryInterface $locationRepository,
        GeoCalculationServiceInterface $geoCalculationService
    ) {
        $this->locationRepository = $locationRepository;
        $this->geoCalculationService = $geoCalculationService;
    }

    public function __invoke(FetchLocationRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();

        $area = $this->geoCalculationService->calculateLatLongArea(
            $data->getLatitude(),
            $data->getLongitude(),
            $data->getDistance()
        );

        $locationCollection = $this->locationRepository->fetch($data);

        return LocationApiResource::collection($locationCollection);
    }
}
