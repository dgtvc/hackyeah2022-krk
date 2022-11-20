<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\GeoCalculationServiceInterface;

final class GeoCalculationService implements GeoCalculationServiceInterface
{
    /**
     * Earth Radius in kilometers
     */
    public const EARTH_RADIUS = 6371;

    /**
     * @param  float  $lat
     * @param  float  $lng
     * @param  int  $distance
     * @return array
     */
    public function calculateLatLongArea(float $lat, float $lng, int $distance): array
    {
        $maxLat = $lat + rad2deg($distance / self::EARTH_RADIUS);
        $minLat = $lat - rad2deg($distance/ self::EARTH_RADIUS);
        $maxLon = $lng + rad2deg(asin($distance / self::EARTH_RADIUS) / cos(deg2rad($lat)));
        $minLon = $lng - rad2deg(asin($distance / self::EARTH_RADIUS) / cos(deg2rad($lat)));

        return [
            'min_lat' => $minLat,
            'max_lat' => $maxLat,
            'min_lng' => $minLon,
            'max_lng' => $maxLon,
        ];
    }
}
