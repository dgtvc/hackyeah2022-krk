<?php

declare(strict_types=1);

namespace App\DataTransferObject;

final class FetchQueryDto
{
    private ?array $trashType;
    private ?array $recycleType;
    private ?int $distance;
    private ?string $lat;
    private ?string $lng;

    public function __construct(
        ?array $trashType,
        ?array $recycleType,
        ?int $distance,
        ?string $lat,
        ?string $lng,
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

    public function getLat(): float
    {
        return floatval($this->lat);
    }

    public function getLng(): float
    {
        return floatval($this->lng);
    }
}
