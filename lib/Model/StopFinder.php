<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class StopFinder
{
    /**
     * @var SimplePoint[]
     */
    private $points;

    /**
     * Returns only the "stop" points
     *
     * @return SimplePoint[]
     */
    public function getStopPoints(): array
    {
        $filtered = array_filter($this->getPoints(), function(SimplePoint $point) {
            return $point->getAnyType() === SimplePoint::TYPE_STOP;
        });

        return array_values($filtered);
    }

    /**
     * @return SimplePoint[]
     */
    public function getPoints(): array
    {
        return $this->points;
    }

    /**
     * @param SimplePoint[] $points
     */
    public function setPoints(array $points): void
    {
        $this->points = $points;
    }
}