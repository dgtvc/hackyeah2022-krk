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
     * @param string $lat
     * @param string $lng
     * @param int $distance
     * @return array
     */
    public function calculateLatLongArea(string $lat, string $lng, int $distance): array
    {
        $lat = (float) $lat;
        $lng = (float) $lng;

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
