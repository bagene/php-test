<?php

namespace Repositories;

use Contracts\NewsRepositoryInterface;
use Shared\AbstractRepository;

class NewsRepository extends AbstractRepository implements NewsRepositoryInterface
{
    protected string $table = 'news';
    protected string $modelName = \Models\News::class;
}
