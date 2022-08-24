<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class TripResponse extends AbstractDefaultResponse
{
    /**
     * @var Trip[]|null
     */
    private $trips;

    /**
     * @return Trip[]|null
     */
    public function getTrips(): ?array
    {
        return $this->trips;
    }

    /**
     * @param Trip[]|null $trips
     */
    public function setTrips(?array $trips): void
    {
        $this->trips = $trips;
    }
}