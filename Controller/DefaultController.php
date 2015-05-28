<?php

namespace UnitedWorldWrestling\Bundle\FlightStatsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UnitedWorldWrestlingFlightStatsBundle:Default:index.html.twig', array('name' => $name));
    }
}
