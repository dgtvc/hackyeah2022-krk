<?php

declare(strict_types=1);

namespace App\DataTransferObject;

final class FetchQueryDto
{
    private string $trashType;
    private string $recycleType;
    private int $distance;
    private string $latitude;
    private string $longitude;

    public function __construct(
        string $trashType,
        string $recycleType,
        int $distance,
        string $latitude,
        string $longitude,
    ) {
        $this->trashType = $trashType;
        $this->recycleType = $recycleType;
        $this->distance = $distance;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getTrashType(): string
    {
        return $this->trashType;
    }

    public function getRecycleType(): string
    {
        return $this->recycleType;
    }

    public function getDistance(): int
    {
        return $this->distance;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }
}
