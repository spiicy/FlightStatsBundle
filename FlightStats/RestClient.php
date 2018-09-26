<?php

namespace Spiicy\Bundle\FlightStatsBundle\FlightStats;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;

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
     * Prepare the Guzzle request
     *
     * @param string $apiCall the API call function
     * @param array $params Parameters (Optional)
     * @return array
     */
    protected function request($apiCall, $params = array())
    {
        $handler = HandlerStack::create();

        $appId  = $this->config['app_id'];
        $appKey = $this->config['app_key'];

        $handler->unshift(Middleware::mapRequest(function (RequestInterface $request) use ($appId, $appKey) {
            return $request->withUri(
                Uri::withQueryValue(
                    Uri::withQueryValue(
                        $request->getUri(),
                        'appKey',
                        $appKey
                        ),
                    'appId',
                    $appId
                )
            );
        }));

        $client = new Client([
            'debug'    => filter_var(@$this->config['debug'], FILTER_VALIDATE_BOOLEAN),
            'base_uri' => $this->apiUrl,
            'handler'  => $handler,
            'headers'  => [
                'Content-Type' => 'application/json;charset=UTF-8',
            ],
        ]);

        return $client->get($apiCall, $params);
    }
}