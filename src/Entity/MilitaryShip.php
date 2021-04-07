<?php

declare(strict_types=1);

namespace Entity;

/**
 * MilitaryShip
 *
 * @uses Ship
 * @package Entity
 */
class MilitaryShip extends Ship
{
    public const TYPE_DREADNOUGHT = 1;
    public const TYPE_INTERCEPTOR = 2;
    public const TYPE_LEVIATHAN   = 3;
}
