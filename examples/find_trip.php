<?php
declare(strict_types=1);

use Gared\EFA\Client;
use Gared\EFA\Request\StationRequest;
use Gared\EFA\Request\TripRequest;

require __DIR__ . '/../vendor/autoload.php';

$client = new Client(Client::BASE_URL_AVV);

$systemService = $client->getSystem();
echo 'SYSTEM: ' . $systemService->getSystem()->getServerID() . ' (' . $systemService->getSystem()->getVersion() . ')' . PHP_EOL . PHP_EOL;

$stationRequest = new StationRequest('Augsburg, Hauptbahnhof');
$stationService = $client->findStations($stationRequest);
$response = $stationService->getStations();
$depStationId = $response->getStopFinder()->getStopPoints()[0]->getRef()->getId();

$stationRequest = new StationRequest('Augsburg, Universität');
$stationService = $client->findStations($stationRequest);
$response = $stationService->getStations();
$destStationId = $response->getStopFinder()->getStopPoints()[0]->getRef()->getId();

$tripRequest = new TripRequest($depStationId, $destStationId, new DateTime());
$tripService = $client->findTrip($tripRequest);

$tripService->next();
$tripService->next();

$trips = $tripService->getTrips();

foreach ($trips->getTrips() as $trip) {
    echo 'Duration: ' . $trip->getDuration() . PHP_EOL;

    foreach ($trip->getLegs() as $leg) {
        echo ' => ' . $leg->getMode()->getName() . ' - direction ' . $leg->getMode()->getDestination() . ' at ' . $leg->getPoints()[0]->getDateTime()->getTime() . PHP_EOL;
    }
}


