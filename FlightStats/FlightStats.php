<?php

namespace Spiicy\Bundle\FlightStatsBundle\FlightStats;

use Spiicy\Bundle\FlightStatsBundle\FlightStats\RestClient;

class FlightStats extends RestClient
{

    protected $config;
    protected $apiUrl;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->apiUrl = 'https://api.flightstats.com/flex/';
    }

    /**
     *
     * @return \Spiicy\Bundle\FlightStatsBundle\FlightStats\Methods\FlightStatus
     */
    public function getFlightStatus()
    {
        $api = $this->apiUrl . 'flightstatus/rest/v2/json/';
        
        return new Methods\FlightStatus($this->config, $api);
    }

    /**
     *
     * @return \Spiicy\Bundle\FlightStatsBundle\FlightStats\Methods\Schedules
     */
    public function getSchedules()
    {
        $api = $this->apiUrl . 'schedules/rest/v1/json/';
        
        return new Methods\Schedules($this->config, $api);
    }

    /**
     *
     * @return \Spiicy\Bundle\FlightStatsBundle\FlightStats\Methods\Airlines
     */
    public function getAirlines()
    {
        $api = $this->apiUrl . 'airlines/rest/v1/json/';
        
        return new Methods\Airlines($this->config, $api);
    }

    /**
     *
     * @return \Spiicy\Bundle\FlightStatsBundle\FlightStats\Methods\Airports
     */
    public function getAirports()
    {
        $api = $this->apiUrl . 'airports/rest/v1/json/';
        
        return new Methods\Airports($this->config, $api);
    }

    /**
     *
     * @return \Spiiicy\Bundle\FlightStatsBundle\FlightStats\Methods\Alerts
     */
    public function getAlerts()
    {
        $api = $this->apiUrl . 'alerts/rest/v1/json/';
        
        return new Methods\Alerts($this->config, $api);
    }

}