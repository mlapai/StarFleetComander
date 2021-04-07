<?php

declare(strict_types=1);

namespace Entity;

/**
 * CivilShip
 *
 * @uses Ship
 * @package Entity
 */
class CivilShip extends Ship
{
    public const TYPE_TRANSPORT   = 4;
    public const TYPE_RECREATION  = 5;

    public const AVAILABLE_SHIP_TYPES = [
        self::TYPE_TRANSPORT  => self::TYPE_TRANSPORT,
        self::TYPE_RECREATION => self::TYPE_RECREATION
    ];
}
