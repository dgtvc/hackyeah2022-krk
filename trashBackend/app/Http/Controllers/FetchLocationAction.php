<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DataTransferObject\FetchQueryDto;
use App\Http\Requests\FetchLocationRequest;
use App\Http\Resources\LocationApiResource;
use App\Interfaces\GeoCalculationServiceInterface;
use App\Repositories\LocationRepositoryInterface;
use Illuminate\Http\JsonResponse;
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

    public function __invoke(FetchLocationRequest $request): JsonResponse|AnonymousResourceCollection
    {
        $data = new FetchQueryDto(
            trashType: $request->get('trashType'),
            recycleType: $request->get('recycleType'),
            distance: (int) $request->get('distance'),
            lat: $request->get('lat'),
            lng: $request->get('lng'),
        );

        $area = $this->geoCalculationService->calculateLatLongArea(
            $data->getLat(),
            $data->getLng(),
            $data->getDistance()
        );

        $locationCollection = $this->locationRepository->fetch($data, $area);

        return LocationApiResource::collection($locationCollection);
    }
}
