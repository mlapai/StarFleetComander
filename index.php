<?php

declare(strict_types=1);

require __DIR__.'/vendor/autoload.php';

use Factory\FleetFactory;
use Repository\ShipRepository;
use Service\NullLogger;
use Service\RandomShipDataGenerator;
use Service\StarFleetCommander;

// should be in DIC
$randomShipDataGenerator = new RandomShipDataGenerator();
$shipRepository          = new ShipRepository($randomShipDataGenerator);
$fleetFactory            = new FleetFactory();
$logger                  = new NullLogger();

$starShipCommander = new StarFleetCommander($fleetFactory, $shipRepository, $logger);
$fleet             = $starShipCommander->assambleAttackPositionsFleet();

// could be presented with command pattern
print_r($fleet->getFormation());

$starShipCommander->assambleEscortPositionsFleet($fleet);

print_r($fleet->getFormation());
