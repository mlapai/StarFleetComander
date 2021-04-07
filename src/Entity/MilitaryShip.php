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

    public const AVAILABLE_SHIP_TYPES = [
        self::TYPE_DREADNOUGHT => self::TYPE_DREADNOUGHT,
        self::TYPE_INTERCEPTOR => self::TYPE_INTERCEPTOR,
        self::TYPE_LEVIATHAN   => self::TYPE_LEVIATHAN
    ];
}
