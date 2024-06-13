<?php

declare(strict_types=1);

namespace Contracts;

use Models\Comment;
use Shared\RepositoryInterface;

interface CommentRepositoryInterface extends RepositoryInterface
{
    public function getCommentWithNews(int $id): Comment;
}
