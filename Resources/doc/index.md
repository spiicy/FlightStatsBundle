Getting started with FlightStatsBundle
=======================================


## Installation

  * [Installation procedure](installation.md)


## Usage

Scheduled Flight(s) by carrier and flight number, arriving on the given date.  

``` php
// src/Acme/DemoBundle/Controller/DemoController.php
$flightStats = $this->container->get('spiiicy_flightstats');
$schedule = $flightStats->getSchedules()->scheduleByFlightNumber('AC', '1857', new \DateTime('2015-06-01'));
```


