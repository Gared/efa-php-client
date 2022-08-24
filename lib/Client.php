<?php

namespace Gared\EFA;

use Gared\EFA\Normalizer\PointsNormalizer;
use Gared\EFA\Request\DepartureService;
use Gared\EFA\Request\StationService;
use Gared\EFA\Request\SystemService;
use Gared\EFA\Request\TripService;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class Client
{
    public const BASE_URL_AVV = 'https://efa.avv-augsburg.de/avv2/';
    public const BASE_URL_MVV = 'https://efa.mvv-muenchen.de/bcl/';
    public const BASE_URL_VRR = 'https://efa.vrr.de/vrr/';
    public const BASE_URL_GVH = 'https://efa156.efa.de/efaws2/default/';

    private ClientInterface $httpClient;
    private SerializerInterface $serializer;
    private int $sessionId = 0;

    /**
     * @var array
     */
    private const DEFAULT_PARAMS = [
        'outputFormat' => 'JSON',
        'stateless' => 1,
        'locationServerActive' => 1,
        'coordOutputFormat' => 'WGS84[DD.DDDDD]',
        'coordOutputFormatTail' => 5,
        'sessionID' => 0,
        'requestID' => 0,
        'mId' => 'efa_www',
    ];

    public function __construct(string $baseUrl)
    {
        $this->httpClient = $this->createDefaultHttpClient($baseUrl);

        $encoders = [new JsonEncoder(), new XmlEncoder()];
        $normalizers = [
            new ArrayDenormalizer(),
            new PointsNormalizer(null, null, null, new PhpDocExtractor()),
            new ObjectNormalizer(null, null, null, new PhpDocExtractor()),
        ];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function setClient(ClientInterface $client): void
    {
        $this->httpClient = $client;
    }

    public function findStations(string $name): StationService
    {
        return new StationService($this->httpClient, $this->getSerializer(), $name, 'any', self::DEFAULT_PARAMS);
    }

    public function findTrip(string $depStation, string $destStation): TripService
    {
        return $this->getTripService($depStation, $destStation);
    }

    public function findDepartures(string $depStation): DepartureService
    {
        return $this->getDepartureService($depStation);
    }

    public function getSystem(): SystemService
    {
        return new SystemService($this->httpClient, $this->getSerializer());
    }

    public function getSessionId(): int
    {
        return $this->sessionId;
    }

    public function setSessionId(int $sessionId): void
    {
        $this->sessionId = $sessionId;
    }

    private function createDefaultHttpClient(string $baseUrl): ClientInterface
    {
        return new \GuzzleHttp\Client([
            'base_uri' => $baseUrl,
            RequestOptions::TIMEOUT => 10,
            RequestOptions::CONNECT_TIMEOUT => 10,
        ]);
    }

    private function getSerializer(): SerializerInterface
    {
        return $this->serializer;
    }

    protected function getTripService(string $depStation, string $destStation): TripService
    {
        return new TripService($this->httpClient, $this->getSerializer(), $depStation, $destStation, self::DEFAULT_PARAMS);
    }

    protected function getDepartureService(string $depStation): DepartureService
    {
        return new DepartureService($this->httpClient, $this->getSerializer(), $depStation, self::DEFAULT_PARAMS);
    }
}