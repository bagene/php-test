<?php

namespace Shared;

use Contracts\DBServiceInterface;

abstract class AbstractRepository implements RepositoryInterface
{
    protected string $table;
    protected string $modelName;

    public function __construct(
        protected readonly DBServiceInterface $database,
    ) {
    }

    public function create(AbstractModel $data): AbstractModel
    {
        $columns = implode(", ", array_keys($data->toArray()));
        $values = implode(", ", array_map(fn($value) => "'{$value}'", array_values($data->toArray())));

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($values)";

        $result = $this->database->execute($sql);

        if ($result === false) {
            throw new \Exception("Failed to create record");
        }

        return $this->find($data->getId());
    }

    public function find(
        int $id,
        ?string $rel = null,
        ?string $relColumn = null,
        string $joinType = 'INNER JOIN',
    ): AbstractModel {
        $sql = "SELECT * FROM {$this->table} WHERE id = $id";

        $result = $this->database->select($sql);

        if ($result === false) {
            throw new \Exception("Record not found");
        }

        return $this->convertToModel($result[0]);
    }

    /** @inheritDoc */
    public function get(array $filter = []): array
    {
        $sql = "SELECT * FROM {$this->table}";

        if (!empty($filter)) {
            $sql .= " WHERE ";
            $sql .= implode(" AND ", array_map(fn($key, $value) => "$key = $value", array_keys($filter), array_values($filter)));
        }

        $results = $this->database->select($sql);

        if ($results === false) {
            return [];
        }

        return array_map(function ($result) {
            /** @var class-string<AbstractModel> $model */
            $model = $this->modelName;

            return $this->convertToModel($result);
        }, $results);
    }

    private function convertToModel(array $data): AbstractModel
    {
        /** @var class-string<AbstractModel> $model */
        $model = $this->modelName;

        $reflection = new \ReflectionClass($model);
        $args = $reflection->getConstructor()
            ->getParameters();

        $payload = [];

        foreach ($args as $arg) {
            $default = $arg->isDefaultValueAvailable() ? $arg->getDefaultValue() : null;
            $key = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $arg->getName()));
            $payload[$arg->getName()] = $data[$key] ?? $default;
        }

        return $model::fromArray($payload);
    }
}
