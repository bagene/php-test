<?php

declare(strict_types=1);

namespace Models;

use Concerns\StaticConstructor;
use Shared\AbstractModel;

final class News extends AbstractModel
{
    use StaticConstructor;

    private function __construct(
        private readonly int $id,
        private readonly string $title,
        private readonly string $body,
        private readonly string $createdAt,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
