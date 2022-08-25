# PHP client library for EFA API 

This library is written in PHP and is using guzzle for requesting the EFA API.
An API to request informations about public transport in a city.
Used in cities in Germany like Augsburg, Munich or Münster. 

## Installation

Use composer
```console
composer require gared/efa-php-client
```

## Usage examples

### Configure client

Initialize Client with base url for the EFA API.
```php
$client = new \Gared\EFA\Client(\Gared\EFA\Client::BASE_URL_MVV);
```


| Transport association         | constant      |
|-------------------------------|---------------|
| Münchner Verkehrs Verbund     | BASE_URL_MVV  |
| Augsburger Verkehrs Verbund   | BASE_URL_AVV  |
| Verkehrsverbund Rhein-Ruhr    | BASE_URL_VRR  |
| Großraum-Verkehr Hannover     | BASE_URL_GVH  |
| Braunschweiger Verkehrs-GmbH  | BASE_URL_BSVG |


### Find stations 

```php
$stationService = $client->findStations('Hauptbahnhof');
$response = $stationService->getStations();

foreach ($response->getStopFinder()->getPoints() as $point) {
    if ($point->getAnyType() === 'stop') {
        echo $point->getName() . ': ' . $point->getRef()->getLatitude() . ' ' . $point->getRef()->getLongitude() . PHP_EOL;
    }
}
```

## Supported Platforms

* You need at least PHP 7.4

## Documentation

This library using the following endpoints:

| Endpoint                 | Method name             | Description                                                                              |
|--------------------------|-------------------------|------------------------------------------------------------------------------------------|
| XML_STOPFINDER_REQUEST   | $client->findStations   | Get stations and POIs                                                                    |
| XML_TRIP_REQUEST2        | $client->findTrip       | Get (realtime) informations about transportation possibilities from one place to another |
| XML_DM_REQUEST           | $client->findDepartures | Get departure informations of a station                                                  |
| XML_SYSTEMINFO_REQUEST   | $client->getSystem      | Get system info and version                                                              |
| XML_ADDINFO_REQUEST      | TODO                    | Get additional informations like interferences                                           |

Read more about this API here:
* [EFA-API from muensterhack.de](https://www.muensterhack.de/themes/mshack/assets/docs/2015_EFA-API.pdf)
* [Documentation of OpenVRR](https://www.openvrr.de/pages/api)
