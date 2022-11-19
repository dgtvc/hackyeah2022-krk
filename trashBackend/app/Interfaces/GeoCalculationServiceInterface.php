<?php

declare(strict_types=1);

namespace App\Interfaces;

interface GeoCalculationServiceInterface
{
    public function calculateLatLongArea(string $latitude, string $longitude, int $distance): array;
}
