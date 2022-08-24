<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class ServingLine
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $symbol;

    /**
     * @var string
     */
    private $motType;

    /**
     * @var string
     */
    private $mtSubcode;

    /**
     * @var string
     */
    private $realtime;

    /**
     * @var string
     */
    private $direction;

    /**
     * @var string
     */
    private $directionFrom;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $destId;

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     */
    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }

    /**
     * @return string
     */
    public function getMotType(): string
    {
        return $this->motType;
    }

    /**
     * @param string $motType
     */
    public function setMotType(string $motType): void
    {
        $this->motType = $motType;
    }

    /**
     * @return string
     */
    public function getMtSubcode(): string
    {
        return $this->mtSubcode;
    }

    /**
     * @param string $mtSubcode
     */
    public function setMtSubcode(string $mtSubcode): void
    {
        $this->mtSubcode = $mtSubcode;
    }

    /**
     * @return string
     */
    public function getRealtime(): string
    {
        return $this->realtime;
    }

    public function isRealtime(): bool
    {
        return $this->realtime === '1';
    }

    /**
     * @param string $realtime
     */
    public function setRealtime(string $realtime): void
    {
        $this->realtime = $realtime;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @param string $direction
     */
    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }

    /**
     * @return string
     */
    public function getDirectionFrom(): string
    {
        return $this->directionFrom;
    }

    /**
     * @param string $directionFrom
     */
    public function setDirectionFrom(string $directionFrom): void
    {
        $this->directionFrom = $directionFrom;
    }

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
    public function getDestId(): string
    {
        return $this->destId;
    }

    /**
     * @param string $destId
     */
    public function setDestId(string $destId): void
    {
        $this->destId = $destId;
    }
}