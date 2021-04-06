<?php

declare(strict_types=1);

namespace Entity;

use InvalidArgumentException;

/**
 * Fleet
 *
 * @uses FleetInterface
 * @final
 * @package Entity
 */
final class Fleet implements FleetInterface
{
    public const RANDOM_POSITIONS    = 0;
    public const ATTACKING_POSITIONS = 1;
    public const ESCORT_POSITIONS    = 2;

    public const AVAILABLE_FORMATION_TYPES = [
        self::RANDOM_POSITIONS    => self::RANDOM_POSITIONS,
        self::ATTACKING_POSITIONS => self::ATTACKING_POSITIONS,
        self::ESCORT_POSITIONS    => self::ESCORT_POSITIONS
    ];

    /**
     * @param Ship[] $ships 
     * @return void 
     */
    private array $formation;

    private int $formationType = self::RANDOM_POSITIONS;

    public array $callSignNumbers;

    /**
     * Constructor
     *
     * @param Ship... $Ship
     * @access public
     */
    public function __construct(Ship ...$ships)
    {
        $this->formation = $ships;
        $this->nameShips();
    }

    /**
     * {@inheritdoc}
     */
    public function attackPositions(): void 
    { 
        // @todo do the magic
        $this->formationType = self::ATTACKING_POSITIONS;
    }

    /**
     * {@inheritdoc}
     */
    public function escortPositions(): void 
    {
        // @todo do the magic
        $this->formationType = self::ESCORT_POSITIONS;
    }

    /**
     * {@inheritdoc}
     */
    public function getFormation(): array 
    {
        return $this->formation;
    }

    /**
     * {@inheritdoc}
     */
    public function getFormationType(): int 
    {
        return $this->formationType;
    }

    /**
     * {@inheritdoc}
     */
    public function addShip(Ship $ship): bool
    {
        $this->formation[] = $ship;
        $this->reapplyFormation();

        $uniqueFleetNumber = max($this->callSignNumbers) + 1;
        $this->nameShip($ship, $uniqueFleetNumber);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function removeShip(Ship $ship): bool
    {
        $key = array_search($ship, $this->formation, true);

        if ($key === false) {
            return false;
        }

        unset($this->formation[$key]);
        $this->reapplyFormation();

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function reapplyFormation(): void
    {
        if ($this->formationType === self::RANDOM_POSITIONS) {
            return;
        }

        $this->formation = $this->formationType === self::ATTACKING_POSITIONS
            ? $this->attackPositions()
            : $this->escortPositions();
    }

    /**
     * Give unique names to the ships within the fleet
     *
     * @access private
     * @return void
     */
    private function nameShips(): void
    {
        foreach ($this->formation as $key => $ship) {
            $shipNumber = $key + 1;
            $this->nameShip($ship, $shipNumber);
        }
    }

    /**
     * Give 
     *
     * @param Ship $ship
     * @param int $shipNumber
     * @access private
     * @return void
     */
    private function nameShip(Ship $ship, int $shipNumber): void
    {
        if (in_array($shipNumber, $this->callSignNumbers)) {
            throw new InvalidArgumentException("Ship number $shipNumber must be unique within the fleet");
        }

        $callSign = get_class($ship) . " " . $shipNumber . $this->getShipSufix($ship);

        $ship->setCallSign($callSign);
        $this->callSignNumbers[] = $shipNumber;
    }

    /**
     * Determine ship suffix depending on the captain exp
     *
     * @param Ship $ship
     * @access private
     * @return string
     */
    private function getShipSufix(Ship $ship): string
    {
        return (!$ship->captainHasExp() ? "Junior" : "");
    }
}
