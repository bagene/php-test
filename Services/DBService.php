<?php

declare(strict_types=1);

namespace Services;

use Concerns\singleton;
use Contracts\DBServiceInterface;

class DBService implements DBServiceInterface
{
    use singleton;

    private \PDO $pdo;

    public function __construct(
        private readonly string $host,
        private readonly string $port,
        private readonly string $username,
        private readonly string $password,
        private readonly string $dbname,
        private readonly string $charset,
    ) {
        $this->createConnection();
    }

    private function createConnection(): void
    {
        $this->pdo = new \PDO(
            "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}",
            $this->username,
            $this->password
        );
    }

    public function getLastInsertId(): int
    {
        return (int)$this->pdo->lastInsertId();
    }

    public function getNextId(): int
    {
        return (int)$this->pdo->lastInsertId() + 1;
    }

    public function select(string $sql): array|false
    {
        $sth = $this->pdo->query($sql);
        return $sth->fetchAll();
    }

    public function execute(string $sql): bool
    {
        return $this->pdo->exec($sql);
    }
}
