<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class Departure
{
    /**
     * @var string
     */
    private $stopId;

    /**
     * @var string
     */
    private $x;

    /**
     * @var string
     */
    private $y;

    /**
     * @var string
     */
    private $platform;

    /**
     * @var string
     */
    private $platformName;

    /**
     * @var string
     */
    private $stopName;

    /**
     * @var string
     */
    private $countdown;

    /**
     * @var DateTimeSimple
     */
    private $dateTime;

    private ?DateTimeSimple $realDateTime = null;

    /**
     * @var ServingLine
     */
    private $servingLine;

    /**
     * @return string
     */
    public function getStopId(): string
    {
        return $this->stopId;
    }

    /**
     * @param string $stopId
     */
    public function setStopId(string $stopId): void
    {
        $this->stopId = $stopId;
    }

    /**
     * @return string
     */
    public function getX(): string
    {
        return $this->x;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return (float)$this->x;
    }

    /**
     * @param string $x
     */
    public function setX(string $x): void
    {
        $this->x = $x;
    }

    /**
     * @return string
     */
    public function getY(): string
    {
        return $this->y;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return (float)$this->y;
    }

    /**
     * @param string $y
     */
    public function setY(string $y): void
    {
        $this->y = $y;
    }

    /**
     * @return string
     */
    public function getPlatform(): string
    {
        return $this->platform;
    }

    /**
     * @param string $platform
     */
    public function setPlatform(string $platform): void
    {
        $this->platform = $platform;
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
    public function getStopName(): string
    {
        return $this->stopName;
    }

    /**
     * @param string $stopName
     */
    public function setStopName(string $stopName): void
    {
        $this->stopName = $stopName;
    }

    /**
     * @return string
     */
    public function getCountdown(): string
    {
        return $this->countdown;
    }

    /**
     * @param string $countdown
     */
    public function setCountdown(string $countdown): void
    {
        $this->countdown = $countdown;
    }

    /**
     * @return DateTimeSimple
     */
    public function getDateTime(): DateTimeSimple
    {
        return $this->dateTime;
    }

    /**
     * @param DateTimeSimple $dateTime
     */
    public function setDateTime(DateTimeSimple $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    public function getRealDateTime(): ?DateTimeSimple
    {
        return $this->realDateTime;
    }

    /**
     * @param DateTimeSimple $realDateTime
     */
    public function setRealDateTime(DateTimeSimple $realDateTime): void
    {
        $this->realDateTime = $realDateTime;
    }

    /**
     * @return ServingLine
     */
    public function getServingLine(): ServingLine
    {
        return $this->servingLine;
    }

    /**
     * @param ServingLine $servingLine
     */
    public function setServingLine(ServingLine $servingLine): void
    {
        $this->servingLine = $servingLine;
    }
}