<?php

declare(strict_types=1);

require __DIR__.'/vendor/autoload.php';

use Factory\FleetFactory;
use Repository\ShipRepository;
use Service\NullLogger;
use Service\StarFleetCommander;

$shipRepository = new ShipRepository();
$fleetFactory   = new FleetFactory();
$logger         = new NullLogger();

$starShipCommander = new StarFleetCommander($fleetFactory, $shipRepository, $logger);
$fleet             = $starShipCommander->assambleAttackPositionsFleet();

print_r($fleet->getFormation());

$starShipCommander->assambleEscortPositionsFleet($fleet);

print_r($fleet->getFormation());
