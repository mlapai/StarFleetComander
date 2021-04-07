<?php

declare(strict_types=1);

namespace Repository;

/**
 * EntityRepository
 *
 * @package Repository
 */
interface EntityRepository
{
    /**
     * Find all entities
     *
     * @access public
     * @return array
     */
    public function findAll(): array;

    /**
     * Find one by
     *
     * @access public
     * @return void
     */
    public function findOneBy();
}
