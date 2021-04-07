<?php

declare(strict_types=1);

namespace Service;

use Entity\CivilShip;
use Entity\MilitaryShip;
use Factory\ShipFactory;

/**
 * RandomShipDataGenerator
 *
 * @final
 * @package Service
 */
final class RandomShipDataGenerator implements ShipDataGeneratorInterface
{
    public const MAX_NUMBER_OF_SAME_SHIPS = 5;
    public const MIN_NUMBER_OF_SAME_SHIPS = 1;

    /**
     * Generate random number of each ship type
     *
     * @access public
     * @return Ship[]
     */
    public function generateShips(): array
    {
        $shipTypes = array_merge(MilitaryShip::AVAILABLE_SHIP_TYPES, CivilShip::AVAILABLE_SHIP_TYPES);
        $ships     = [];

        foreach ($shipTypes as $shipType) {

            $shipStrength     = rand(1, count($shipTypes));
            $numberOfSameShip = rand(self::MIN_NUMBER_OF_SAME_SHIPS, self::MAX_NUMBER_OF_SAME_SHIPS);
            $captainExp       = (bool) rand(0, 1);

            $ships[] = $this->generateShipXTimes($shipType, $shipStrength, $numberOfSameShip, $captainExp);
        }

        // flatten two dimensional array
        return array_merge(...$ships);
    }

    /**
     * Generate same ship X number of times
     *
     * @param int $shipType
     * @param int $numberOfShips
     * @param bool $captainExp
     * @access private
     * @return array
     */
    private function generateShipXTimes(int $shipType, int $strength, int $x, bool $captainExp): array
    {
        if ($x === 0) {
            return [];
        }

        $ships = [];

        for ($i = 1; $i <= $x; $i++) {
            $ships[] = ShipFactory::createShip($shipType, $strength, $captainExp);
        }

        return $ships;
    }
}
