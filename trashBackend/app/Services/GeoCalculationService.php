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
     * @param string $latitude
     * @param string $longitude
     * @param int $distance
     * @return array
     */
    public function calculateLatLongArea(string $latitude, string $longitude, int $distance): array
    {
        $lat = (float) $latitude;
        $lon = (float) $longitude;

        $maxLat = $lat + rad2deg($distance / self::EARTH_RADIUS);
        $minLat = $lat - rad2deg($distance/ self::EARTH_RADIUS);
        $maxLon = $lon + rad2deg(asin($distance / self::EARTH_RADIUS) / cos(deg2rad($lat)));
        $minLon = $lon - rad2deg(asin($distance / self::EARTH_RADIUS) / cos(deg2rad($lat)));

        return [
            'min_latitude' => $minLat,
            'max_latitude' => $maxLat,
            'min_longitude' => $minLon,
            'max_longitude' => $maxLon,
        ];
    }
}
