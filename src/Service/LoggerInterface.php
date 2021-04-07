<?php

declare(strict_types=1);

namespace Service;

/**
 * LoggerInterface
 *
 * @package Service
 */
interface LoggerInterface
{
    /**
     * Log message
     *
     * @param string $message
     * @access public
     * @return void
     */
    public function log(string $message);
}
