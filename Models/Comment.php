<?php

namespace Models;

use Concerns\StaticConstructor;
use Shared\AbstractModel;

class Comment extends AbstractModel
{
    use StaticConstructor;

    private function __construct(
        private readonly int $id,
        private readonly string $body,
        private readonly string $createdAt,
        private readonly int $newsId,
        private ?News $news
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getNews(): News
    {
        return $this->news;
    }

    public function setNews(?News $news): void
    {
        $this->news = $news;
    }

    public function getNewsId(): int
    {
        return $this->newsId;
    }
}
