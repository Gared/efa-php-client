<?php
declare(strict_types=1);

namespace Gared\EFA\Request;

use DateTime;

class DepartureRequest extends RequestAbstract
{
    private string $depStation;
    private DateTime $dateTime;
    private bool $isDateTimeDep = true;
    private bool $useRealtime = true;

    public function __construct(string $depStation)
    {
        $this->depStation = $depStation;
        $this->dateTime = new DateTime();
    }

    public function getDepStation(): string
    {
        return $this->depStation;
    }

    public function setDepStation(string $depStation): DepartureRequest
    {
        $this->depStation = $depStation;
        return $this;
    }

    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    public function setDateTime(DateTime $dateTime): DepartureRequest
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    public function isDateTimeDep(): bool
    {
        return $this->isDateTimeDep;
    }

    public function setIsDateTimeDep(bool $isDateTimeDep): DepartureRequest
    {
        $this->isDateTimeDep = $isDateTimeDep;
        return $this;
    }

    public function isUseRealtime(): bool
    {
        return $this->useRealtime;
    }

    public function setUseRealtime(bool $useRealtime): DepartureRequest
    {
        $this->useRealtime = $useRealtime;
        return $this;
    }
}