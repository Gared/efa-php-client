<?php
declare(strict_types=1);

namespace Gared\EFA\Request;

class StationRequest extends RequestAbstract
{
    private string $name;
    private string $type = 'any';

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): StationRequest
    {
        $this->name = $name;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): StationRequest
    {
        $this->type = $type;
        return $this;
    }
}