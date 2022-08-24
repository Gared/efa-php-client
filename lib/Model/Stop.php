<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class Stop
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $place;

    /**
     * @var string
     */
    private $platFormName;

    /**
     * @var string
     */
    private $desc;

    /**
     * @var Ref
     */
    private $ref;

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
    public function getPlatFormName(): string
    {
        return $this->platFormName;
    }

    /**
     * @param string $platFormName
     */
    public function setPlatFormName(string $platFormName): void
    {
        $this->platFormName = $platFormName;
    }

    /**
     * @return string
     */
    public function getDesc(): string
    {
        return $this->desc;
    }

    /**
     * @param string $desc
     */
    public function setDesc(string $desc): void
    {
        $this->desc = $desc;
    }

    /**
     * @return Ref
     */
    public function getRef(): Ref
    {
        return $this->ref;
    }

    /**
     * @param Ref $ref
     */
    public function setRef(Ref $ref): void
    {
        $this->ref = $ref;
    }
}