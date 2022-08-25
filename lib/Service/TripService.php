<?php
declare(strict_types=1);

namespace Gared\EFA\Service;

use Gared\EFA\Model\Parameter;
use Gared\EFA\Model\TripResponse;
use Gared\EFA\Request\TripRequest;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class TripService
{
    private const TRIP_FINDER_ENDPOINT = 'XML_TRIP_REQUEST2';

    public const TYPE_DEP = 'dep';
    public const TYPE_DEST = 'dest';

    public const LINE_RESTRICTION_ALL = '400';
    public const LINE_RESTRICTION_WITHOUT_ICE = '401';
    public const LINE_RESTRICTION_WITHOUT_ADD_COSTS = '402';
    public const LINE_RESTRICTION_LOCAL_TRAFFIC = '403';

    public const ROUTE_TYPE_LEAST_INTERCHANGE = 'leastinterchange';
    public const ROUTE_TYPE_LEAST_TIME = 'leasttime';
    public const ROUTE_TYPE_LEAST_WALKING = 'leastwalking';

    /**
     * „no Operation“
     */
    public const COMMAND_NOP = 'nop';
    /**
     * Modify request
     */
    public const COMMAND_CHANGE_REQUEST = 'changeRequest';
    /**
     * New request with defaults
     */
    public const COMMAND_TRIP_RETOURE = 'tripRetoure';
    /**
     * New request with start as default
     */
    public const COMMAND_TRIP_GO_ON = 'tripGoOn';
    /**
     * Previous trips
     */
    public const COMMAND_TRIP_PREV = 'tripPrev';
    /**
     * Next trips
     */
    public const COMMAND_TRIP_NEXT = 'tripNext';
    /**
     * Last trip
     */
    public const COMMAND_TRIP_LAST = 'tripLast';
    /**
     * First trip
     */
    public const COMMAND_TRIP_FIRST = 'tripFirst';
    /**
     * Übersicht drucken (PDF)
     */
    public const COMMAND_PRINT_OVERVIEW = 'printOverview';
    /**
     * Einzelansicht drucken (n - Fahrtindex)
     */
    public const COMMAND_PRINT_SINGLEVIEW = 'printSingleview:n';

    private ClientInterface $client;
    private SerializerInterface $serializer;
    private ResponseInterface $response;
    private TripRequest $tripRequest;
    private TripResponse $serializedResponse;
    private string $sessionId;

    public function __construct(ClientInterface $client, SerializerInterface $serializer, TripRequest $tripRequest)
    {
        $this->client = $client;
        $this->serializer = $serializer;
        $this->tripRequest = $tripRequest;

        $this->fetchTrips();
    }

    private function fetchTrips(): void
    {
        $parameters = [
            'name_origin' => $this->tripRequest->getDepStation(),
            'name_destination' => $this->tripRequest->getDestStation(),
            'type_origin' => 'any',
            'type_destination' => 'any',
            'itdDateTimeDepArr' => $this->tripRequest->isDateTimeDep() ? self::TYPE_DEP : self::TYPE_DEST,
            'itdDate' => $this->tripRequest->getDateTime()->format('Ymd'),
            'itdTime' => $this->tripRequest->getDateTime()->format('Hi'),
            'lineRestriction' => self::LINE_RESTRICTION_ALL,
            'routeType' => self::ROUTE_TYPE_LEAST_TIME,
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
        $response = $this->client->request('GET', self::TRIP_FINDER_ENDPOINT, [
            RequestOptions::QUERY => array_merge($this->tripRequest->getDefaultParameters(), $parameters),
        ]);
        $this->convertResponse($response);
    }

    private function convertResponse(ResponseInterface $response): void
    {
        $this->response = $response;
        $result = (string) $this->response->getBody();
        $result = mb_convert_encoding($result, 'UTF-8', 'UTF-8');

        $this->serializedResponse = $this->serializer->deserialize($result, TripResponse::class, 'json');
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getTrips(): TripResponse
    {
        return $this->serializedResponse;
    }
}