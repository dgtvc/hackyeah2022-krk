<?php

declare(strict_types=1);

namespace App\DataTransferObject;

final class FetchQueryDto
{
    private ?array $trashType;
    private ?array $recycleType;
    private ?int $distance;
    private ?float $lat;
    private ?float $lng;

    public function __construct(
        ?array $trashType,
        ?array $recycleType,
        ?int $distance,
        ?float $lat,
        ?float $lng,
    ) {
        $this->trashType = $trashType;
        $this->recycleType = $recycleType;
        $this->distance = $distance;
        $this->lat = $lat;
        $this->lng = $lng;
    }

    public function getTrashType(): ?array
    {
        return $this->trashType;
    }

    public function getRecycleType(): ?array
    {
        return $this->recycleType;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }
}
