<?php

namespace Repositories;

use Contracts\CommentRepositoryInterface;
use Contracts\DBServiceInterface;
use Contracts\NewsRepositoryInterface;
use Models\Comment;
use Models\News;
use Shared\AbstractRepository;

class CommentRepository extends AbstractRepository implements CommentRepositoryInterface
{
    protected string $table = 'comment';
    protected string $modelName = \Models\Comment::class;

    public function __construct(DBServiceInterface $database, private readonly NewsRepositoryInterface $newsRepository)
    {
        parent::__construct($database);
    }

    public function getCommentWithNews(int $id): Comment
    {
        /** @var Comment $comment */
        $comment = parent::find($id, 'news', 'news_id');

        /** @var News $news */
        $news = $this->newsRepository->find($comment->getNewsId());

        $comment->setNews($news);

        return $comment;
    }
}
