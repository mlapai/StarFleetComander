<?php

declare(strict_types=1);

namespace Entity;

/**
 * FleetInterface
 *
 * @package Entity
 */
interface FleetInterface
{
    /**
     * Organize ships into attacking positions
     *
     * @access public
     * @return void
     */
    public function attackPositions(): void;

    /**
     * Organize ships into escort positions
     *
     * @access public
     * @return void
     */
    public function escortPositions(): void;

    /**
     * Get Fleet formation
     *
     * @access public
     * @return void
     */
    public function getFormation(): array;

    /**
     * Get current formation type
     *
     * @access public
     * @return intvoid
     */
    public function getCurrentFormationType(): int;

    /**
     * Add ship to the fleet
     *
     * @param Ship $ship
     * @access public
     * @return bool
     */
    public function addShip(Ship $ship): bool;

    /**
     * Remove ship from the fleet
     *
     * @param Ship $ship
     * @access public
     * @return bool
     */
    public function removeShip(Ship $ship): bool;

    /**
     * reapplyPositions
     *
     * @access public
     * @return void
     */
    public function reapplyFormation(): void;
}
