<?php

declare(strict_types=1);

namespace Service;

use Entity\FleetInterface;

/**
 * StarFleetCommander
 *
 * @uses FleetCommanderInterface
 * @package Service
 */
final class StarFleetCommander implements FleetCommanderInterface
{
    private $shipFactory;

    private $fleetFactory;

    private $shipRepository;

    /**
     * Constructor
     *
     * @param mixed $shipFactory
     * @param mixed $fleetFactory
     * @param mixed $shipRepository
     * @access public
     */
    public function __construct($shipFactory, $fleetFactory, $shipRepository)
    {
        $this->shipFactory    = $shipFactory;
        $this->fleetFactory   = $fleetFactory;
        $this->shipRepository = $shipRepository;
    }


    /**
     * {@inheritdoc}
     */
    public function assambleAttackPositionsFleet(): FleetInterface 
    {
        $fleet = $this->assambleFleet();
        $fleet->attackPositions();

        return $fleet;
    }

    /**
     * {@inheritdoc}
     */
    public function assambleEscortPositionsFleet(): FleetInterface 
    {
        $fleet = $this->assambleFleet();
        $fleet->escortPositions();

        return $fleet;
    }

    /**
     * {@inheritdoc}
     */
    public function assambleFleet(): FleetInterface
    { 
        // load ships with repo
        // @todo ship factory to produce ships
        // @todo fleet factory to produce fleet
    }
}
