<?php

namespace Spiiicy\Bundle\FlightStatsBundle\FlightStats\Methods;

use Spiiicy\Bundle\FlightStatsBundle\FlightStats\RestClient;
use Spiiicy\Bundle\FlightStatsBundle\FlightStats\FlightStatsAPIException;

class Airlines extends RestClient {

    /**
     * Returns a listing of currently active airlines
     * 
     * @link https://developer.flightstats.com/api-docs/airlines/v1
     * @return JSON
     * @throws \Exception
     * @throws FlightStatsAPIException
     */
    public function getActiveAirlines() {
        
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