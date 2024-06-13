<?php

namespace Concerns;

use Shared\AbstractModel;

trait StaticConstructor
{
    public static function fromArray(array $data): static
    {
        return new static(...$data);
    }
}
