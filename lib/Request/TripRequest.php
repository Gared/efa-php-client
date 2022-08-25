<?php
declare(strict_types=1);

namespace Gared\EFA\Request;

use DateTime;

class TripRequest extends RequestAbstract
{
    public const LINE_RESTRICTION_ALL = '400';
    public const LINE_RESTRICTION_WITHOUT_ICE = '401';
    public const LINE_RESTRICTION_WITHOUT_ADD_COSTS = '402';
    public const LINE_RESTRICTION_LOCAL_TRAFFIC = '403';

    public const ROUTE_TYPE_LEAST_INTERCHANGE = 'leastinterchange';
    public const ROUTE_TYPE_LEAST_TIME = 'leasttime';
    public const ROUTE_TYPE_LEAST_WALKING = 'leastwalking';

    /**
     * „no Operation“
     */
    public const COMMAND_NOP = 'nop';
    /**
     * Modify request
     */
    public const COMMAND_CHANGE_REQUEST = 'changeRequest';
    /**
     * New request with defaults
     */
    public const COMMAND_TRIP_RETOURE = 'tripRetoure';
    /**
     * New request with start as default
     */
    public const COMMAND_TRIP_GO_ON = 'tripGoOn';
    /**
     * Previous trips
     */
    public const COMMAND_TRIP_PREV = 'tripPrev';
    /**
     * Next trips
     */
    public const COMMAND_TRIP_NEXT = 'tripNext';
    /**
     * Last trip
     */
    public const COMMAND_TRIP_LAST = 'tripLast';
    /**
     * First trip
     */
    public const COMMAND_TRIP_FIRST = 'tripFirst';
    /**
     * Übersicht drucken (PDF)
     */
    public const COMMAND_PRINT_OVERVIEW = 'printOverview';
    /**
     * Einzelansicht drucken (n - Fahrtindex)
     */
    public const COMMAND_PRINT_SINGLEVIEW = 'printSingleview:n';

    private string $depStation;
    private string $destStation;
    private DateTime $dateTime;
    private bool $isDateTimeDep = true;

    public function __construct(string $depStation, string $destStation, DateTime $dateTime)
    {
        $this->depStation = $depStation;
        $this->destStation = $destStation;
        $this->dateTime = $dateTime;
    }

    public function getDepStation(): string
    {
        return $this->depStation;
    }

    public function setDepStation(string $depStation): TripRequest
    {
        $this->depStation = $depStation;
        return $this;
    }

    public function getDestStation(): string
    {
        return $this->destStation;
    }

    public function setDestStation(string $destStation): TripRequest
    {
        $this->destStation = $destStation;
        return $this;
    }

    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    public function setDateTime(DateTime $dateTime): TripRequest
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    public function isDateTimeDep(): bool
    {
        return $this->isDateTimeDep;
    }

    public function setIsDateTimeDep(bool $isDateTimeDep): TripRequest
    {
        $this->isDateTimeDep = $isDateTimeDep;
        return $this;
    }
}