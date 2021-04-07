<?php

declare(strict_types=1);

namespace Repository;

use Entity\CivilShip;
use Entity\MilitaryShip;
use Exception\ShipsNotFoundException;
use Factory\ShipFactory;

/**
 * ShipRepository
 *
 * @uses EntityRepository
 * @final
 * @package Repository
 */
final class ShipRepository implements EntityRepository
{
    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {

        $dreadnought  = ShipFactory::createShip(MilitaryShip::TYPE_DREADNOUGHT, 5, false);
        $dreadnought1 = ShipFactory::createShip(MilitaryShip::TYPE_DREADNOUGHT, 5, false);
        $dreadnought2 = ShipFactory::createShip(MilitaryShip::TYPE_DREADNOUGHT, 5, false);
        $interceptor  = ShipFactory::createShip(MilitaryShip::TYPE_INTERCEPTOR, 4, true);
        $leviathan1   = ShipFactory::createShip(MilitaryShip::TYPE_LEVIATHAN, 3, false);
        $leviathan2   = ShipFactory::createShip(MilitaryShip::TYPE_LEVIATHAN, 3, false);
        $transport1   = ShipFactory::createShip(CivilShip::TYPE_TRANSPORT, 2, true);
        $transport2   = ShipFactory::createShip(CivilShip::TYPE_TRANSPORT, 2, true);
        $recreation   = ShipFactory::createShip(CivilShip::TYPE_RECREATION, 1, true);

        return [
            $transport1,
            $leviathan1,
            $interceptor,
            $dreadnought,
            $recreation,
            $dreadnought2,
            $leviathan2,
            $transport2,
            $dreadnought1
        ];
    }

    /**
     * Get all ships, throw exception if ships were not found
     *
     * @access public
     * @throws ShipsNotFoundException
     * @return array
     */
    public function getAll(): array
    {
        $result = $this->findAll();

        if (!$result) {
            throw new ShipsNotFoundException("No ships were found", 404);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy()
    {
        // @todo it's not necessary yet
    }
}
