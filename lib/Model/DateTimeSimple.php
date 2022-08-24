<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class DateTimeSimple
{
    private string $year;
    private string $month;
    private string $day;
    private string $weekday;
    private string $hour;
    private string $minute;

    public function getYear(): string
    {
        return $this->year;
    }

    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    public function getMonth(): string
    {
        return $this->month;
    }

    public function setMonth(string $month): void
    {
        $this->month = $month;
    }

    public function getDay(): string
    {
        return $this->day;
    }

    public function setDay(string $day): void
    {
        $this->day = $day;
    }

    public function getWeekday(): string
    {
        return $this->weekday;
    }

    public function setWeekday(string $weekday): void
    {
        $this->weekday = $weekday;
    }

    public function getHour(): string
    {
        return $this->hour;
    }

    public function setHour(string $hour): void
    {
        $this->hour = $hour;
    }

    public function getMinute(): string
    {
        return $this->minute;
    }

    public function setMinute(string $minute): void
    {
        $this->minute = $minute;
    }

    public function getDateTime(): \DateTime
    {
        $dateTime = new \DateTime();
        $dateTime->setDate((int)$this->year, (int)$this->month, (int)$this->day);
        $dateTime->setTime((int)$this->hour, (int)$this->minute);

        return $dateTime;
    }

    public function __toString()
    {
        return $this->getDateTime()->format('Y-m-d H:i');
    }
}