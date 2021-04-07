<?php

declare(strict_types=1);

namespace Factory;

use Entity\FleetInterface;
use Entity\Ship;

/**
 * FleetFactoryInterface
 *
 * @package Factory
 */
interface FleetFactoryInterface
{
    /**
     * Create new fleet
     *
     * @param Ship... $ships
     * @access public
     * @return FleetInterface
     */
    public function createFleet(Ship ...$ships): FleetInterface;
}
