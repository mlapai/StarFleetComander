<?php

declare(strict_types=1);

namespace Service;

use Entity\FleetInterface;

/**
 * FleetCommanderInterface
 *
 * @package Entity\FleetInterface
 */
interface FleetCommanderInterface
{
    /**
     * Assamble fleet with attacking positions
     *
     * @access public
     * @return FleetInterface
     */
    public function assambleAttackPositionsFleet(): FleetInterface;

    /**
     * Assamble fleet with escort positions
     *
     * @access public
     * @return FleetInterface
     */
    public function assambleEscortPositionsFleet(): FleetInterface;

    /**
     * Assamble new fleet
     *
     * @access public
     * @return FleetInterface
     */
    public function assambleFleet(): FleetInterface;
}
