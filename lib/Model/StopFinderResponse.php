<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class StopFinderResponse extends AbstractDefaultResponse
{
    /**
     * @var StopFinder
     */
    private $stopFinder;

    /**
     * @return StopFinder
     */
    public function getStopFinder(): StopFinder
    {
        return $this->stopFinder;
    }

    /**
     * @param StopFinder $stopFinder
     */
    public function setStopFinder(StopFinder $stopFinder): void
    {
        $this->stopFinder = $stopFinder;
    }
}