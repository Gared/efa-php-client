<?php
declare(strict_types=1);

namespace Gared\EFA\Service;

use Gared\EFA\Model\SystemResponse;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class SystemService
{
    private const SYSTEMINFO_ENDPOINT = 'XML_SYSTEMINFO_REQUEST';

    private ClientInterface $client;
    private SerializerInterface $serializer;
    private ResponseInterface $response;
    private SystemResponse $serializedResponse;

    public function __construct(ClientInterface $client, SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;

        $this->fetchInfos();
    }

    private function fetchInfos(): void
    {
        $this->doRequest();
    }

    private function doRequest(): void
    {
        $response = $this->client->request('GET', self::SYSTEMINFO_ENDPOINT);
        $this->convertResponse($response);
    }

    private function convertResponse(ResponseInterface $response): void
    {
        $this->response = $response;
        $result = $this->response->getBody()->getContents();

        $this->serializedResponse = $this->serializer->deserialize($result, SystemResponse::class, 'xml');
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getSystem(): SystemResponse
    {
        return $this->serializedResponse;
    }
}