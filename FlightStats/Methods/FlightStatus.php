<?php

namespace Spiicy\Bundle\FlightStatsBundle\FlightStats\Methods;

use Spiicy\Bundle\FlightStatsBundle\FlightStats\RestClient;
use Spiicy\Bundle\FlightStatsBundle\FlightStats\FlightStatsAPIException;

class FlightStatus extends RestClient {

    /**
     * Get the Flight Statuses for the given Carrier and Flight Number that arrived on the given date.
     * 
     * @link https://developer.flightstats.com/api-docs/flightstatus/v2/flight
     * @param string $carrier
     * @param string $number 
     * @param \DateTime $arrival
     * @return JSON
     * @throws \Exception
     * @throws FlightStatsAPIException
     */
    public function statusByFlightNumber($carrier, $flight, $arrival) {
        
        $params = array(
            'carrier' => $carrier,
            'flight' => $flight,
            'year' => $arrival->format('Y'),
            'month' => $arrival->format('m'),
            'day' => $arrival->format('d'),
        );

        $apiCall = sprintf('flight/status/%s/%s/arr/%d/%d/%d', $params['carrier'], $params['flight'], $params['year'], $params['month'], $params['day']);

        $res = $this->request($apiCall);

        $code = $res->getStatusCode();
        $json = json_decode($res->getBody()->getContents(), true);
        
        if (isset($json['error'])) {
            throw new FlightStatsAPIException($json);
        } else {
            return isset($json) ? $json : false;
        }
    }

    /**
     * Returns the positional tracks of flights, with a given carrier and flight number, arriving or having arrived on the given date
     * 
     * @link https://developer.flightstats.com/api-docs/flightstatus/v2/flight
     * @param string $carrier
     * @param string $number 
     * @param \DateTime $arrival
     * @return JSON
     * @throws \Exception
     * @throws FlightStatsAPIException
     */
    public function trackByFlightNumber($carrier, $flight, $arrival) {
        
        $params = array(
            'carrier' => $carrier,
            'flight' => $flight,
            'year' => $arrival->format('Y'),
            'month' => $arrival->format('m'),
            'day' => $arrival->format('d'),
        );

        $apiCall = sprintf('flight/tracks/%s/%s/arr/%d/%d/%d', $params['carrier'], $params['flight'], $params['year'], $params['month'], $params['day']);

        $res = $this->request($apiCall);

        $code = $res->getStatusCode();
        $json = json_decode($res->getBody()->getContents(), true);
        
        if (isset($json['error'])) {
            throw new FlightStatsAPIException($json);
        } else {
            return isset($json) ? $json : false;
        }
    }

}