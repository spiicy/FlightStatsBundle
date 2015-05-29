<?php

namespace UnitedWorldWrestling\Bundle\FlightStatsBundle\FlightStats;

use UnitedWorldWrestling\Bundle\FlightStatsBundle\FlightStats\RestClient;

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
     * @return \UnitedWorldWrestling\Bundle\FlightStatsBundle\FlightStats\Methods\FlightStatus
     */
    public function getFlightStatus()
    {
        $api = $this->apiUrl . 'flightstatus/rest/v2/json/';
        
        return new Methods\FlightStatus($this->config, $api);
    }

    /**
     *
     * @return \UnitedWorldWrestling\Bundle\FlightStatsBundle\FlightStats\Methods\Schedules
     */
    public function getSchedules()
    {
        $api = $this->apiUrl . 'schedules/rest/v1/json/';
        
        return new Methods\Schedules($this->config, $api);
    }

}