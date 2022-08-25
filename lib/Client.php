<?php
declare(strict_types=1);

namespace Gared\EFA;

use Gared\EFA\Normalizer\PointsNormalizer;
use Gared\EFA\Request\DepartureRequest;
use Gared\EFA\Request\StationRequest;
use Gared\EFA\Request\TripRequest;
use Gared\EFA\Service\DepartureService;
use Gared\EFA\Service\StationService;
use Gared\EFA\Service\SystemService;
use Gared\EFA\Service\TripService;
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
    public const BASE_URL_BSVG = 'https://bsvg.efa.de/bsvagstd/';

    private ClientInterface $httpClient;
    private SerializerInterface $serializer;
    private int $sessionId = 0;

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

    public function findStations(StationRequest $stationRequest): StationService
    {
        return new StationService($this->httpClient, $this->getSerializer(), $stationRequest);
    }

    public function findTrip(TripRequest $tripRequest): TripService
    {
        return new TripService($this->httpClient, $this->getSerializer(), $tripRequest);
    }

    public function findDepartures(DepartureRequest $departureRequest): DepartureService
    {
        return new DepartureService($this->httpClient, $this->getSerializer(), $departureRequest);
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
}