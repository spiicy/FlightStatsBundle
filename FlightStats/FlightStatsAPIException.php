<?php

namespace Spiicy\Bundle\FlightStatsBundle\FlightStats;

class FlightStatsAPIException extends \Exception {

    public function __construct($data) {
        parent::__construct(sprintf('FlightStats API error : [ %s ] %s , code = %s', $data['error']['errorId'], $data['error']['message'], $data['error']['errorCode']), $data['error']['httpStatusCode']);
    }

}