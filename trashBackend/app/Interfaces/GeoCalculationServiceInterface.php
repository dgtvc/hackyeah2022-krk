<?php

declare(strict_types=1);

namespace App\Interfaces;

interface GeoCalculationServiceInterface
{
    public function calculateLatLongArea(float $lat, float $lng, int $distance): array;
}
