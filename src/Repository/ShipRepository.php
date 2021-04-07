<?php

declare(strict_types=1);

namespace Repository;

use Exception\ShipsNotFoundException;
use Service\ShipDataGeneratorInterface;

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
     * @var ShipDataGeneratorInterface $shipDataGenerator
     */
    private $shipDataGenerator;

    /**
     * Constructor
     *
     * @param ShipDataGeneratorInterface $shipDataGenerator
     * @access public
     */
    public function __construct(ShipDataGeneratorInterface $shipDataGenerator)
    {
        $this->shipDataGenerator = $shipDataGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return $this->shipDataGenerator->generateShips();
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
