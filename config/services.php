<?php

return [
    \Contracts\DBServiceInterface::class => [
        'class' => \Services\DBService::class,
        'args' => [
            'host' => getenv('DB_HOST'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'dbname' => getenv('DB_NAME'),
            'port' => getenv('DB_PORT'),
            'charset' => 'utf8',
        ]
    ],
    \Contracts\NewsRepositoryInterface::class => \Repositories\NewsRepository::class,
    \Contracts\CommentRepositoryInterface::class => \Repositories\CommentRepository::class,
];
