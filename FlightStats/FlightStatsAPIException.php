<?php

namespace Spiicy\Bundle\FlightStatsBundle\FlightStats;

class FlightStatsAPIException extends \Exception {

    public function __construct($data) {
        parent::__construct(sprintf('FlightStats API error : [ %s ] %s , code = %s', $data['name'], $data['error'], $data['code']),$data['code']);
    }

}