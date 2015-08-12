<?php

namespace Spiiicy\Bundle\FlightStatsBundle\FlightStats\Methods;

use Spiiicy\Bundle\FlightStatsBundle\FlightStats\RestClient;
use Spiiicy\Bundle\FlightStatsBundle\FlightStats\FlightStatsAPIException;

class Alerts extends RestClient 
{

    /**
     * Create a flight rule to be monitored for a specific flight departing from an airport on the given day. 
     * Returns the fully constructed flight rule that was created.
     * 
     * @link https://developer.flightstats.com/api-docs/alerts/v1
     * @param string $carrier
     * @param string $number 
     * @param \DateTime $departure
     * @return JSON
     * @throws \Exception
     * @throws FlightStatsAPIException
     */
    public function createRuleByDeparture(
        $carrier, 
        $flight, 
        $departure_airport, 
        $departure, 
        $events = "dep,can,div,preDep30,depLate30,depDelay,depGate"
    ) {

        $params = array(
            'carrier' => $carrier,
            'flight' => $flight,
            'departureAirport' => $departure_airport,
            'events' => $events,
            'year' => $departure->format('Y'),
            'month' => $departure->format('m'),
            'day' => $departure->format('d'),
        );

        // $apiCall = sprintf('create/%s/%s/from/%s/departing/%d/%d/%d?type=JSON&events=%s&deliverTo=%s', 
        $apiCall = sprintf('create/%s/%s/from/%s/departing/%d/%d/%d', 
                $params['carrier'], 
                $params['flight'], 
                $params['departureAirport'], 
                $params['year'], 
                $params['month'], 
                $params['day']
            );

        $res = $this->request($apiCall, 
            [
                "query" => ["type" => "JSON", "events" => $events, "deliverTo" => $this->config['deliver_to']]
            ]
        );

        $code = $res->getStatusCode();
        $json = json_decode($res->getBody()->getContents(), true);
        
        if (isset($json['error'])) {
            throw new FlightStatsAPIException($json);
        } else {
            return isset($json) ? $json : false;
        }

    }

}