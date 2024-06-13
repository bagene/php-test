<?php

declare(strict_types=1);

namespace Shared;

use Concerns\StaticConstructor;

/**
 * Class AbstractModel
 * @method static fromArray(array $data): AbstractModel
 * @const string TABLE
 */
abstract class AbstractModel
{
    private string $table;

    public function toArray(): array
    {
        $reflectionClass = new \ReflectionClass(get_class($this));
        $response = [];

        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            $methodName = $method->getName();
            /** @var \ReflectionNamedType|null $returnType */
            $returnType = $method->getReturnType();

            if (
                $method->isConstructor() ||
                $method->isStatic() ||
                'toArray' === $methodName ||
                'void' === $returnType?->getName()
            ) {
                continue;
            }

            $key = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $methodName));
            $response[$key] = $this->{$methodName}();
        }

        return $response;
    }

    public function getTable(): string
    {
        return $this->table;
    }
}
