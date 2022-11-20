<?php

declare(strict_types=1);

namespace App\Interfaces;

interface GeoCalculationServiceInterface
{
    public function calculateLatLongArea(string $lat, string $lng, int $distance): array;
}
