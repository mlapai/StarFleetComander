<?php

declare(strict_types=1);

namespace Entity;

/**
 * Ship
 *
 * @abstract
 * @package Entity
 */
abstract class Ship
{
    protected int $strength;
    protected string $callSign;
    protected bool $captainExp;

    /**
     * Constructor
     *
     * @param int $strength
     * @param bool $captainExp
     * @access public
     */
    public function __construct(int $strength, bool $captainExp)
    {
        $this->strength   = $strength;
        $this->captainExp = $captainExp;
    }

    /**
     * getStrength
     *
     * @access public
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * setCallSign
     *
     * @param string $callSign
     * @access public
     * @return void
     */
    public function setCallSign(string $callSign): void
    {
        $this->callSign = $callSign;
    }

    /**
     * getCallSign
     *
     * @access public
     * @return string
     */
    public function getCallSign(): string
    {
        return $this->callSign;
    }

    /**
     * captainHasExp
     *
     * @access public
     * @return bool
     */
    public function captainHasExp(): bool
    {
        return $this->captainExp;
    }
}
