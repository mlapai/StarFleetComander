<?php

declare(strict_types=1);

use Service\StarFleetCommander;

require __DIR__.'/vendor/autoload.php';

$starShipCommander = new StarFleetCommander(null, null, null);
$fleet             = $starShipCommander->assambleAttackPositionsFleet();

var_dump($fleet->getFormation());
