<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class SimplePoint
{
    public const TYPE_STOP = 'stop';
    public const TYPE_POI = 'poi';

    /**
     * @var string
     */
    private $usage;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $stateless;

    /**
     * @var string
     */
    private $anyType;

    /**
     * @var string
     */
    private $object;

    /**
     * @var Ref
     */
    private $ref;

    /**
     * @return string
     */
    public function getUsage(): string
    {
        return $this->usage;
    }

    /**
     * @param string $usage
     */
    public function setUsage(string $usage): void
    {
        $this->usage = $usage;
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
    public function getStateless(): string
    {
        return $this->stateless;
    }

    /**
     * @param string $stateless
     */
    public function setStateless(string $stateless): void
    {
        $this->stateless = $stateless;
    }

    /**
     * @return string
     */
    public function getAnyType(): string
    {
        return $this->anyType;
    }

    /**
     * @param string $anyType
     */
    public function setAnyType(string $anyType): void
    {
        $this->anyType = $anyType;
    }

    /**
     * @return string
     */
    public function getObject(): string
    {
        return $this->object;
    }

    /**
     * @param string $object
     */
    public function setObject(string $object): void
    {
        $this->object = $object;
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