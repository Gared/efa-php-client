<?php
declare(strict_types=1);

namespace Gared\EFA\Service;

use Gared\EFA\Model\DepartureResponse;
use Gared\EFA\Model\Parameter;
use Gared\EFA\Request\DepartureRequest;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DepartureService
{
    private const DEPARTURE_MONITOR_ENDPOINT = 'XML_DM_REQUEST';

    public const TYPE_DEP = 'dep';
    public const TYPE_DEST = 'dest';

    public const LINE_RESTRICTION_ALL = '400';
    public const LINE_RESTRICTION_WITHOUT_ICE = '401';
    public const LINE_RESTRICTION_WITHOUT_ADD_COSTS = '402';
    public const LINE_RESTRICTION_LOCAL_TRAFFIC = '403';

    public const ROUTE_TYPE_LEAST_INTERCHANGE = 'leastinterchange';
    public const ROUTE_TYPE_LEAST_TIME = 'leasttime';
    public const ROUTE_TYPE_LEAST_WALKING = 'leastwalking';

    private ClientInterface $client;
    private SerializerInterface $serializer;
    private ResponseInterface $response;
    private DepartureResponse $serializedResponse;
    private string $sessionId;
    private string $body;
    private DepartureRequest $departureRequest;

    public function __construct(ClientInterface $client, SerializerInterface $serializer, DepartureRequest $departureRequest)
    {
        $this->client = $client;
        $this->serializer = $serializer;
        $this->departureRequest = $departureRequest;

        $this->fetchDepartures();
    }

    private function fetchDepartures(): void
    {
        $parameters = [
            'name_dm' => $this->departureRequest->getDepStation(),
            'type_dm' => 'any',
            'mode' => 'direct',
            'useRealtime' => $this->departureRequest->isUseRealtime() ? '1' : '0',
            'itdDateTimeDepArr' => $this->departureRequest->isDateTimeDep() ? self::TYPE_DEP : self::TYPE_DEST,
            'itdDate' => $this->departureRequest->getDateTime()->format('Ymd'),
            'itdTime' => $this->departureRequest->getDateTime()->format('Hi'),
//            'lineRestriction' => self::LINE_RESTRICTION_ALL,
//            'routeType' => self::ROUTE_TYPE_LEAST_TIME,
        ];

        $this->doRequest($parameters);

        $this->sessionId = $this->serializedResponse->getParameter(Parameter::KEY_SESSION)->getValue();
    }

    /**
     * Load also next trips (your search results + next trips)
     */
    public function next(): void
    {
        $parameters = [
            'sessionID' => $this->sessionId,
            'requestID' => '1',
            'command' => 'tripNext',
        ];

        $this->doRequest($parameters);
    }

    /**
     * Load also previous trips (your search results + previous trips)
     */
    public function previous(): void
    {
        $parameters = [
            'sessionID' => $this->sessionId,
            'requestID' => '1',
            'command' => 'tripPrev',
        ];

        $this->doRequest($parameters);
    }

    private function doRequest(array $parameters): void
    {
        $response = $this->client->request('GET', self::DEPARTURE_MONITOR_ENDPOINT, [
            RequestOptions::QUERY => array_merge($this->departureRequest->getDefaultParameters(), $parameters),
        ]);
        $this->convertResponse($response);
    }

    private function convertResponse(ResponseInterface $response): void
    {
        $this->response = $response;
        $result = $this->response->getBody()->getContents();
        $this->body = mb_convert_encoding($result, 'UTF-8', 'UTF-8');

        $this->serializedResponse = $this->serializer->deserialize($this->body, DepartureResponse::class, 'json');
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function getDepartures(): DepartureResponse
    {
        return $this->serializedResponse;
    }
}