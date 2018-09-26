<?php

namespace Spiicy\Bundle\FlightStatsBundle\FlightStats\Methods;

use Spiicy\Bundle\FlightStatsBundle\FlightStats\RestClient;
use Spiicy\Bundle\FlightStatsBundle\FlightStats\FlightStatsAPIException;

class Alerts extends RestClient
{

    /**
     * Returns at most the last thousand Alert Rule IDs.
     * See the alternative form of this to specify the max Rule ID, which allows for iteration over all Rule IDs.
     *
     * @link https://developer.flightstats.com/api-docs/alerts/v1
     * @return JSON
     * @throws \Exception
     * @throws FlightStatsAPIException
     */
    public function listAlert() {

        $apiCall = sprintf('list');

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
        $events = "dep,arr,can,div,preDep30,depLate30,depDelay,depGate"
    ) {

        if (empty($this->config['deliver_to'])) {
            throw new \UnexpectedValueException('FlightStat rule creation requires the "deliver_to" parameter to be set');
        }

        $alert_name = sprintf('%s_%s_%s_%s', $carrier, $flight, $departure_airport, $departure->format('Y-m-d'));

        $params = array(
            'carrier' => $carrier,
            'flight' => $flight,
            'departureAirport' => $departure_airport,
            'events' => $events,
            'year' => $departure->format('Y'),
            'month' => $departure->format('m'),
            'day' => $departure->format('d'),
        );

        $apiCall = sprintf('create/%s/%s/from/%s/departing/%d/%d/%d',
            $params['carrier'],
            $params['flight'],
            $params['departureAirport'],
            $params['year'],
            $params['month'],
            $params['day']
        );

        $res = $this->request($apiCall, array(
            "query" => array(
                "type" => "JSON",
                "name" => $alert_name,
                "events" => $events,
                "deliverTo" => $this->config['deliver_to'],
            ),
        ));

        $code = $res->getStatusCode();
        $json = json_decode($res->getBody()->getContents(), true);

        if (isset($json['error'])) {
            throw new FlightStatsAPIException($json);
        } else {
            return isset($json) ? $json : false;
        }

    }

    /**
     * Returns the flight rule that was previously created given a rule ID.
     *
     * @link https://developer.flightstats.com/api-docs/alerts/v1
     * @param string $rule_id
     * @return JSON
     * @throws \Exception
     * @throws FlightStatsAPIException
     */
    public function getAlert($rule_id) {

        $apiCall = sprintf('get/%d', $rule_id);

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
     * Deletes a flight rule that was previously created given a rule ID. Returns the flight rule that was deleted.
     * Note that once deleted any subsequent calls with the same ID will return a rule not found exception.
     *
     * @link https://developer.flightstats.com/api-docs/alerts/v1
     * @param string $rule_id
     * @return JSON
     * @throws \Exception
     * @throws FlightStatsAPIException
     */
    public function deleteByRuleId($rule_id) {

        $params = array(
            'rule_id' => $rule_id
        );

        $apiCall = sprintf('delete/%d', $rule_id);

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