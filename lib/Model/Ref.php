<?php
declare(strict_types=1);

namespace Gared\EFA\Model;

class Ref
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $gid;

    /**
     * @var string
     */
    private $omc;

    /**
     * @var string
     */
    private $placeID;

    /**
     * @var string
     */
    private $place;

    /**
     * @var string
     */
    private $coords;

    /**
     * @var string
     */
    private $depDateTime;

    /**
     * @var string
     */
    private $arrDelay;

    /**
     * @var string
     */
    private $arrValid;

    /**
     * @var string
     */
    private $depDelay;

    /**
     * @var string
     */
    private $depValid;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getGid(): string
    {
        return $this->gid;
    }

    /**
     * @param string $gid
     */
    public function setGid(string $gid): void
    {
        $this->gid = $gid;
    }

    /**
     * @return string
     */
    public function getOmc(): string
    {
        return $this->omc;
    }

    /**
     * @param string $omc
     */
    public function setOmc(string $omc): void
    {
        $this->omc = $omc;
    }

    /**
     * @return string
     */
    public function getPlaceID(): string
    {
        return $this->placeID;
    }

    /**
     * @param string $placeID
     */
    public function setPlaceID(string $placeID): void
    {
        $this->placeID = $placeID;
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
     * @param string $coords
     */
    public function setCoords(string $coords): void
    {
        $this->coords = $coords;
    }

    /**
     * @return null|float
     */
    public function getLongitude(): ?float
    {
        return (float) $this->parseCoords()['lon'];
    }

    /**
     * @return null|float
     */
    public function getLatitude(): ?float
    {
        return (float) $this->parseCoords()['lat'];
    }

    /**
     * @return string
     */
    public function getDepDateTime(): string
    {
        return $this->depDateTime;
    }

    /**
     * @param string $depDateTime
     */
    public function setDepDateTime(string $depDateTime): void
    {
        $this->depDateTime = $depDateTime;
    }

    /**
     * @return string
     */
    public function getArrDelay(): string
    {
        return $this->arrDelay;
    }

    /**
     * @param string $arrDelay
     */
    public function setArrDelay(string $arrDelay): void
    {
        $this->arrDelay = $arrDelay;
    }

    /**
     * @return string
     */
    public function getArrValid(): string
    {
        return $this->arrValid;
    }

    /**
     * @param string $arrValid
     */
    public function setArrValid(string $arrValid): void
    {
        $this->arrValid = $arrValid;
    }

    /**
     * @return string
     */
    public function getDepDelay(): string
    {
        return $this->depDelay;
    }

    /**
     * @param string $depDelay
     */
    public function setDepDelay(string $depDelay): void
    {
        $this->depDelay = $depDelay;
    }

    /**
     * @return string
     */
    public function getDepValid(): string
    {
        return $this->depValid;
    }

    /**
     * @param string $depValid
     */
    public function setDepValid(string $depValid): void
    {
        $this->depValid = $depValid;
    }

    /**
     * @return array
     */
    private function parseCoords(): array
    {
        $returnNull = [
            'lat' => null,
            'lon' => null,
        ];

        if ($this->coords === null) {
            return $returnNull;
        }

        $coords = explode(',', $this->coords);
        if (count($coords) !== 2) {
            return $returnNull;
        }

        return [
            'lat' => $coords[1],
            'lon' => $coords[0],
        ];
    }
}