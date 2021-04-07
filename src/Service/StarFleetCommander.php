<?php

declare(strict_types=1);

namespace Service;

use Entity\FleetInterface;
use Exception\ShipsNotFoundException;
use Factory\FleetFactoryInterface;
use Repository\ShipRepository;

/**
 * StarFleetCommander
 *
 * @uses FleetCommanderInterface
 * @package Service
 */
final class StarFleetCommander implements FleetCommanderInterface
{
    /**
     * @var FleetFactoryInterface $fleetFactory
     */
    private $fleetFactory;

    /**
     * @var ShipRepository $shipRepository
     */
    private $shipRepository;

    /**
     * @var LoggerInterface $logger
     */
    private $logger;

    /**
     * Constructor
     *
     * @param FleetFactoryInterface $fleetFactory
     * @param ShipRepository $shipRepository
     * @param LoggerInterface $logger
     * @access public
     */
    public function __construct(
        FleetFactoryInterface $fleetFactory,
        ShipRepository $shipRepository,
        LoggerInterface $logger
    ) {
        $this->fleetFactory   = $fleetFactory;
        $this->shipRepository = $shipRepository;
        $this->logger         = $logger;
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
        try {
            $ships = $this->shipRepository->getAll();
            $fleet = $this->fleetFactory->createFleet(...$ships);
        } catch (ShipsNotFoundException $e) {
            $this->logger->log($e->getMessage());

            throw $e;
        }

        return $fleet;
    }
}
