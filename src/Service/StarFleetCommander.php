<?php

declare(strict_types=1);

namespace Service;

use Entity\Dreadnought;
use Entity\Fleet;
use Entity\FleetInterface;
use Entity\Interceptor;
use Entity\Leviathan;
use Entity\Recreation;
use Entity\Transport;

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
    public function assambleAttackPositionsFleet(?FleetInterface $fleet = null): FleetInterface
    {
        if (!$fleet) {
            $fleet = $this->assambleFleet();
        }

        $fleet->attackPositions();

        return $fleet;
    }

    /**
     * {@inheritdoc}
     */
    public function assambleEscortPositionsFleet(?FleetInterface $fleet = null): FleetInterface
    {
        if (!$fleet) {
            $fleet = $this->assambleFleet();
        }

        $fleet->escortPositions();

        return $fleet;
    }

    /**
     * {@inheritdoc}
     */
    public function assambleFleet(): FleetInterface
    { 
        $dreadnought  = new Dreadnought(5, false);
        $dreadnought1 = new Dreadnought(5, false);
        $dreadnought2 = new Dreadnought(5, false);
        $interceptor  = new Interceptor(4, true);
        $leviathan1   = new Leviathan(3, false);
        $leviathan2   = new Leviathan(3, false);
        $transport1   = new Transport(2, true);
        $transport2   = new Transport(2, true);
        $recreation   = new Recreation(1, true);

        return new Fleet(
            $transport1,
            $leviathan1,
            $interceptor,
            $dreadnought,
            $recreation,
            $dreadnought2,
            $leviathan2,
            $transport2,
            $dreadnought1,
        );

        // load ships with repo
        // @todo ship factory to produce ships
        // @todo fleet factory to produce fleet
    }
}
