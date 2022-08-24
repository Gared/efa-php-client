<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class SystemResponse
{
    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $serverID;

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $name = ltrim($name, '@');
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getServerID(): string
    {
        return $this->serverID;
    }

    /**
     * @param string $serverID
     */
    public function setServerID(string $serverID): void
    {
        $this->serverID = $serverID;
    }
}