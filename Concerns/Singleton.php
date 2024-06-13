<?php

declare(strict_types=1);

namespace Concerns;

trait Singleton
{
    private static ?object $instance = null;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
