<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class Leg
{
    private string $timeMinute;

    /**
     * @var Point[]
     */
    private $points;

    private Mode $mode;

    /**
     * @var Stop[]
     */
    private $stopSeq;

    private ?array $infos;

    private string $format;

    /**
     * @var string
     */
    private $path;

    public function getTimeMinute(): string
    {
        return $this->timeMinute;
    }

    public function setTimeMinute(string $timeMinute): void
    {
        $this->timeMinute = $timeMinute;
    }

    /**
     * @return Point[]
     */
    public function getPoints(): array
    {
        return $this->points;
    }

    /**
     * @param Point[] $points
     */
    public function setPoints(array $points): void
    {
        $this->points = $points;
    }

    public function getMode(): Mode
    {
        return $this->mode;
    }

    /**
     * @param Mode $mode
     */
    public function setMode(Mode $mode): void
    {
        $this->mode = $mode;
    }

    /**
     * @return Stop[]
     */
    public function getStopSeq(): array
    {
        return $this->stopSeq;
    }

    /**
     * @param Stop[] $stopSeq
     */
    public function setStopSeq(array $stopSeq): void
    {
        $this->stopSeq = $stopSeq;
    }

    public function getInfos(): ?array
    {
        return $this->infos;
    }

    public function setInfos(?array $infos): void
    {
        $this->infos = $infos;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function setFormat(string $format): void
    {
        $this->format = $format;
    }

    /**
     * @return array
     */
    public function getPath(): array
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $paths = explode(' ', $path);
        $coords = [];
        foreach ($paths as $path) {
            $parts = explode(',', $path);
            $coords[] = [
                'latitude' => $parts[1],
                'longitude' => $parts[0],
            ];
        }
        $this->path = $coords;
    }
}