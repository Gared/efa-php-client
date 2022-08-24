<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class DepartureResponse extends AbstractDefaultResponse
{
    /**
     * @var Departure[]|null
     */
    private $departureList = [];

    /**
     * @return Departure[]
     */
    public function getDepartureList(): array
    {
        return $this->departureList;
    }

    /**
     * @param Departure[]|null $departureList
     */
    public function setDepartureList(?array $departureList): void
    {
        if ($departureList === null) {
            return;
        }

        $this->departureList = $departureList;
    }
}