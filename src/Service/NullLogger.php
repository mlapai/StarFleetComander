<?php

declare(strict_types=1);

namespace Service;

/**
 * NullLogger
 *
 * @uses LoggerInterface
 * @final
 * @package Service
 */
final class NullLogger implements LoggerInterface
{
    /**
     * {@inheritdoc}
     */
    public function log(string $message)
    {
        // do nothing
    }
}
