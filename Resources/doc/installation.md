Installation
============

## Get the bundle using composer

Add FlightStatsBundle by running this command from the terminal at the root of
your Symfony project:

```bash
php composer.phar require unitedworldwrestling/flightstats-bundle 
```


## Enable the bundle

To start using the bundle, register the bundle in your application's kernel class:

``` php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        // ...
        new UnitedWorldWrestling\Bundle\FlightStatsBundle\UnitedWorldWrestlingFlightStatsBundle(),
        // ...
    );
}
```


