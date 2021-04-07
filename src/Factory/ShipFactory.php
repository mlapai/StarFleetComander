<?php

declare(strict_types=1);

namespace Factory;

use Entity\CivilShip;
use Entity\Dreadnought;
use Entity\Interceptor;
use Entity\Leviathan;
use Entity\MilitaryShip;
use Entity\Recreation;
use Entity\Ship;
use Entity\Transport;

/**
 * *** I know that static factories are bad, but it suits my needs perfectly here for the sake of hydration
 * *** Patterns like Factory Method are much better for testing and SOLID but would require much more complexity to pull it off
 *
 * ShipFactory
 *
 * @final
 * @package Factory
 */
final class ShipFactory
{
    /**
     * Create specific ship type
     *
     * @param int $type
     * @param int $strength
     * @param bool $captainExp
     * @static
     * @access public
     * @return Ship
     */
    public static function createShip(int $type, int $strength, bool $captainExp): Ship
    {
        switch ($type) {
            case MilitaryShip::TYPE_DREADNOUGHT:
                return new Dreadnought($strength, $captainExp);
                break;
            case MilitaryShip::TYPE_INTERCEPTOR:
                return new Interceptor($strength, $captainExp);
                break;
            case MilitaryShip::TYPE_LEVIATHAN:
                return new Leviathan($strength, $captainExp);
                break;
            case CivilShip::TYPE_TRANSPORT:
                return new Transport($strength, $captainExp);
                break;
            case CivilShip::TYPE_RECREATION:
                return new Recreation($strength, $captainExp);
                break;
        }

        // this code should not be reached
        throw new \LogicException("Unhandled attribute {$type}");
    }
}
