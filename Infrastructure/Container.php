<?php

declare(strict_types=1);

namespace Infrastructure;

use Concerns\Singleton;

final class Container
{
    use Singleton;

    /** @var object[] $services */
    private array $services = [];

    public function __construct()
    {
        $serviceArray = require __DIR__ . '/../config/services.php';

        foreach ($serviceArray as $key => $service) {
            if (is_array($service) && array_key_exists('class', $service)) {
                $this->set($key, $this->resolveClass($service['class'], $service['args'] ?? []));
                continue;
            }
            $this->set($key, $this->resolveClass($service));
        }
    }

    private function resolveClass(string $className, array $args = []): object
    {
        $reflection = new \ReflectionClass($className);
        $constructor = $reflection->getConstructor();
        $constructorArgs = $constructor->getParameters();

        foreach ($constructorArgs as $arg) {
            $type = $arg->getType();
            $argName = $arg->getName();
            if ($type && !$type->isBuiltin()) {
                $typeName = $type->getName();
                if (array_key_exists($typeName, $this->services)) {
                    $args[$argName] = $this->services[$typeName];
                } else {
                    $args[$argName] = $this->resolveClass($typeName);
                }
            }
        }

        return new $className(...$args);
    }

    private function set(string $key, object $service): void
    {
        $this->services[$key] = $service;
    }

    public function get(string $key): object
    {
        return $this->services[$key];
    }
}
