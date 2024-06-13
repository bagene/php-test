<?php

declare(strict_types=1);

namespace Shared;

interface RepositoryInterface
{
    /** @return AbstractModel[] */
    public function get(): array;

    public function find(int $id): AbstractModel;

    public function create(AbstractModel $data): AbstractModel;
}
