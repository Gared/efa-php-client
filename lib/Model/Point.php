<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class Point
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $platformName;

    /**
     * @var string
     */
    private $plannedPlatformName;

    /**
     * @var string
     */
    private $place;

    /**
     * @var string
     */
    private $pointType;

    /**
     * @var DateTime
     */
    private $dateTime;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPlatformName(): string
    {
        return $this->platformName;
    }

    /**
     * @param string $platformName
     */
    public function setPlatformName(string $platformName): void
    {
        $this->platformName = $platformName;
    }

    /**
     * @return string
     */
    public function getPlace(): string
    {
        return $this->place;
    }

    /**
     * @param string $place
     */
    public function setPlace(string $place): void
    {
        $this->place = $place;
    }

    /**
     * @return string
     */
    public function getPlannedPlatformName(): string
    {
        return $this->plannedPlatformName;
    }

    /**
     * @param string $plannedPlatformName
     */
    public function setPlannedPlatformName(string $plannedPlatformName): void
    {
        $this->plannedPlatformName = $plannedPlatformName;
    }

    /**
     * @return string
     */
    public function getPointType(): string
    {
        return $this->pointType;
    }

    /**
     * @param string $pointType
     */
    public function setPointType(string $pointType): void
    {
        $this->pointType = $pointType;
    }

    /**
     * @return DateTime
     */
    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    /**
     * @param DateTime $dateTime
     */
    public function setDateTime(DateTime $dateTime): void
    {
        $this->dateTime = $dateTime;
    }
}