<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class Trip
{
    /**
     * @var string
     */
    private $distance;

    /**
     * @var string
     */
    private $duration;

    /**
     * @var string
     */
    private $desc;

    /**
     * @var Leg[]
     */
    private array $legs;

    public function getDistance(): string
    {
        return $this->distance;
    }

    public function setDistance(string $distance): void
    {
        $this->distance = $distance;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): void
    {
        $this->duration = $duration;
    }

    public function getDesc(): string
    {
        return $this->desc;
    }

    public function setDesc(string $desc): void
    {
        $this->desc = $desc;
    }

    /**
     * @return Leg[]
     */
    public function getLegs(): array
    {
        return $this->legs;
    }

    /**
     * @param Leg[] $legs
     */
    public function setLegs(array $legs): void
    {
        $this->legs = $legs;
    }


}