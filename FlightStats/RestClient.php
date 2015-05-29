<?php

namespace UnitedWorldWrestling\Bundle\FlightStatsBundle\FlightStats;

use GuzzleHttp\Client;

class RestClient
{

    protected $config;
    protected $apiUrl;

    /**
     * Constructor
     * @param array $config
     * @param string $apiUrl
     */
    public function __construct($config, $apiUrl)
    {
        $this->config = $config;
        $this->apiUrl = $apiUrl;
    }

    /**
     * Prepare the curl request
     *
     * @param string $apiCall the API call function
     * @param array $params Parameters (Optional)
     * @return array
     */
    protected function request($apiCall, $params = array())
    {
        $headers = ['headers' => [
            'appId' => $this->config['app_id'],
            'appKey' => $this->config['app_key'],
            'Content-Type' => 'application/json;charset=UTF-8'
        ]];

        $url = $this->apiUrl . $apiCall;
        
        $client = new Client($headers);
        $res = $client->get($url, $params);

        return $res;
    }

}