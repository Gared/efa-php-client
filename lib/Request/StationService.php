<?php
declare(strict_types=1);

namespace Gared\EFA\Request;

use Gared\EFA\Model\StopFinderResponse;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class StationService
{
    private const STOP_FINDER_ENDPOINT = 'XML_STOPFINDER_REQUEST';

    private ClientInterface $client;
    private SerializerInterface $serializer;
    private array $parameters;
    private ResponseInterface $response;

    public function __construct(ClientInterface $client, SerializerInterface $serializer, string $name, string $type, array $parameters)
    {
        $this->client = $client;
        $this->serializer = $serializer;
        $this->parameters = $parameters;

        $this->fetchStationsForName($name, $type);
    }

    private function fetchStationsForName(string $name, string $type)
    {
        $parameters = array_merge($this->parameters, [
            'name_sf' => $name,
            'type_sf' => $type,
        ]);

        $this->response = $this->client->request('GET', self::STOP_FINDER_ENDPOINT, [
            'query' => $parameters,
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