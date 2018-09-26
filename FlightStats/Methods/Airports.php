<?php

namespace Spiicy\Bundle\FlightStatsBundle\FlightStats\Methods;

use Spiicy\Bundle\FlightStatsBundle\FlightStats\RestClient;
use Spiicy\Bundle\FlightStatsBundle\FlightStats\FlightStatsAPIException;

class Airports extends RestClient {

    /**
     * Returns a listing of all airports registered by FlightStats
     *
     * @link https://developer.flightstats.com/api-docs/airports/v1
     * @return JSON
     * @throws \Exception
     * @throws FlightStatsAPIException
     */
    public function getAllAirports() {

        $apiCall = sprintf('all');

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
     * Returns a listing of currently active airports
     *
     * @link https://developer.flightstats.com/api-docs/airports/v1
     * @return JSON
     * @throws \Exception
     * @throws FlightStatsAPIException
     */
    public function getActiveAirports() {

        $apiCall = sprintf('active');

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