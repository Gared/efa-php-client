<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class AbstractDefaultResponse
{
    /**
     * @var Parameter[]
     */
    private array $parameters;

    /**
     * @var Option
     */
    public $option;

    /**
     * @return Parameter[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param Parameter[] $parameters
     */
    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }

    public function getParameter(string $key): ?Parameter
    {
        foreach ($this->parameters as $parameter) {
            if ($parameter->getName() === $key) {
                return $parameter;
            }
        }

        return null;
    }

    public function getOption(): Option
    {
        return $this->option;
    }

    public function setOption(Option $option): void
    {
        $this->option = $option;
    }


}