<?php

declare(strict_types=1);

namespace Factory;

use Entity\Fleet;
use Entity\FleetInterface;
use Entity\Ship;

/**
 * FleetFactory
 *
 * @uses FleetFactoryInterface
 * @final
 * @package Factory
 */
final class FleetFactory implements FleetFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createFleet(Ship ...$ships): FleetInterface
    {
        return new Fleet(...$ships);
    }
}
