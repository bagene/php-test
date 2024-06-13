<?php

declare(strict_types=1);

namespace Contracts;

interface DBServiceInterface
{
    public function getNextId(): int;

    public function select(string $sql): array|false;

    public function execute(string $sql): bool;
}
