<?php
declare(strict_types=1);

namespace Gared\EFA\Service;

use Gared\EFA\Model\StopFinderResponse;
use Gared\EFA\Request\StationRequest;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class StationService
{
    private const STOP_FINDER_ENDPOINT = 'XML_STOPFINDER_REQUEST';

    private ClientInterface $client;
    private SerializerInterface $serializer;
    private ResponseInterface $response;
    private StationRequest $stationRequest;

    public function __construct(ClientInterface $client, SerializerInterface $serializer, StationRequest $stationRequest)
    {
        $this->client = $client;
        $this->serializer = $serializer;
        $this->stationRequest = $stationRequest;

        $this->fetchStations();
    }

    private function fetchStations()
    {
        $parameters = array_merge($this->stationRequest->getDefaultParameters(), [
            'name_sf' => $this->stationRequest->getName(),
            'type_sf' => $this->stationRequest->getType(),
        ]);

        $this->response = $this->client->request('GET', self::STOP_FINDER_ENDPOINT, [
            RequestOptions::QUERY => $parameters,
        ]);
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getStations(): StopFinderResponse
    {
        $result = $this->response->getBody()->__toString();

        return $this->serializer->deserialize($result, StopFinderResponse::class, 'json');
    }
}