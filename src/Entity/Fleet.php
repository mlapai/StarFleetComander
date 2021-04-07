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
    // position code
    public const RANDOM_POSITIONS    = 0;
    public const ATTACKING_POSITIONS = 1;
    public const ESCORT_POSITIONS    = 2;

    public const AVAILABLE_FORMATION_TYPES = [
        self::RANDOM_POSITIONS    => self::RANDOM_POSITIONS,
        self::ATTACKING_POSITIONS => self::ATTACKING_POSITIONS,
        self::ESCORT_POSITIONS    => self::ESCORT_POSITIONS
    ];

    private const INEXPERIENCED_CAPTAIN_SUFFIX  = "Junior";

    private array $formation;

    private int $currentFormationType = self::RANDOM_POSITIONS;

    public array $callSignNumbers = [];

    /**
     * Constructor
     *
     * @param Ship... $ships
     * @access public
     */
    public function __construct(Ship ...$ships)
    {
        // @todo validate presence of each ship ?

        $this->formation = $ships;
        $this->nameShips();
    }

    /**
     * {@inheritdoc}
     */
    public function attackPositions(): void 
    { 
        if ($this->currentFormationType === self::ATTACKING_POSITIONS) {
            return;
        }

        list($militaryShips, $civilShips) = $this->groupByType();

        // since i have random str for each ship, both groups need to be sorted by str separately
        // if this was constant str per ship type i could've used only one sort and be done with it
        usort($militaryShips, fn($a, $b) => $b->getStrength() - $a->getStrength());
        usort($civilShips, fn($a, $b) => $b->getStrength() - $a->getStrength());

        // merge and append civil at the end
        $newFormation               = array_merge($militaryShips, $civilShips);
        $this->formation            = $newFormation;
        $this->currentFormationType = self::ATTACKING_POSITIONS;
    }

    /**
     * {@inheritdoc}
     */
    public function escortPositions(): void 
    {
        if ($this->currentFormationType === self::ESCORT_POSITIONS) {
            return;
        }

        list($militaryShips, $civilShips) = $this->groupByType();

        // if it's odd number
        // round up to always have higher amount of ships in front of fleet
        $middle       = (int) round(count($militaryShips) / 2);
        $newFormation = $militaryShips;

        // if we had sorted military ships array, shuffle to achieve mixed strength
        if ($this->currentFormationType !== self::RANDOM_POSITIONS) {
            shuffle($newFormation);
        }

        // insert civil ships into the middle of military ones
        array_splice($newFormation, $middle, 0, $civilShips);

        $this->formation            = $newFormation;
        $this->currentFormationType = self::ESCORT_POSITIONS;
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
    public function getCurrentFormationType(): int
    {
        return $this->currentFormationType;
    }

    /**
     * {@inheritdoc}
     */
    public function addShip(Ship $ship): bool
    {
        $this->formation[] = $ship;
        $this->reapplyFormation();

        $uniqueShipNumber = max($this->callSignNumbers) + 1;
        $this->nameShip($ship, $uniqueShipNumber);

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
        unset($this->callSignNumbers[spl_object_hash($ship)]);
        $this->reapplyFormation();

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function reapplyFormation(): void
    {
        if ($this->currentFormationType === self::RANDOM_POSITIONS) {
            return;
        }

        // violation of open close ?
        $this->formation = $this->currentFormationType === self::ATTACKING_POSITIONS
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
            $shipNumber = ++$key;
            $this->nameShip($ship, $shipNumber);
        }
    }

    /**
     * nameShip
     *
     * @todo Maybe not responsibility of Fleet class
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

        $shipName  = $ship->getName();
        $callSign  = "$shipName $shipNumber";
        $shipSufix = $this->getShipSufix($ship);

        if ($shipSufix) {
            $callSign .= " $shipSufix";
        }

        $ship->setCallSign($callSign);
        // track sign numbers because of adding/removing ships
        $this->callSignNumbers[spl_object_hash($ship)] = $shipNumber;
    }

    /**
     * Determine ship suffix depending on the captain exp
     *
     * @todo Maybe not responsibility of Fleet class
     *
     * @param Ship $ship
     * @access private
     * @return string
     */
    private function getShipSufix(Ship $ship): string
    {
        return !$ship->captainHasExp() ? self::INEXPERIENCED_CAPTAIN_SUFFIX : "";
    }

    /**
     * groupByType
     *
     * @access private
     * @return array
     */
    private function groupByType(): array
    {
        $militaryShips = [];
        $civilShips    = [];

        foreach ($this->formation as $ship) {

            if ($ship instanceof MilitaryShip) {
                $militaryShips[] = $ship;

                continue;
            }

            $civilShips[] = $ship;
        }

        return [$militaryShips, $civilShips];
    }
}
