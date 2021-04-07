<?php

declare(strict_types=1);

namespace Service;

/**
 * ShipDataGeneratorInterface
 *
 * @package Service
 */
interface ShipDataGeneratorInterface
{
    /**
     * generateShips
     *
     * @access public
     * @return array
     */
    public function generateShips(): array;
}
