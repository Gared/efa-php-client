<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class DateTime
{
    private string $date;
    private string $time;
    private string $rtDate;
    private string $rtTime;

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function setTime(string $time): void
    {
        $this->time = $time;
    }

    public function getRtDate(): string
    {
        return $this->rtDate;
    }

    public function setRtDate(string $rtDate): void
    {
        $this->rtDate = $rtDate;
    }

    public function getRtTime(): string
    {
        return $this->rtTime;
    }

    public function setRtTime(string $rtTime): void
    {
        $this->rtTime = $rtTime;
    }
}