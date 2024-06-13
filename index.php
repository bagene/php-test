<?php
declare(strict_types=1);

use Infrastructure\Container;

const ROOT = __DIR__;
require_once(ROOT . '/config/autoloader.php');


$container = Container::getInstance();
$newsRepository = $container->get(\Contracts\NewsRepositoryInterface::class);
$commentRepository = $container->get(\Contracts\CommentRepositoryInterface::class);

foreach ($newsRepository->get() as $news) {
    echo("############ NEWS " . $news->getTitle() . " ############\n");
    echo($news->getBody() . "\n");
    foreach ($commentRepository->get(['news_id' => $news->getId()]) as $comment) {
        echo("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n");
    }
}
