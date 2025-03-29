<?php

namespace App\Core\Database;

use App\Attributes\Column;
use App\Attributes\Table;
use PDO;
use ReflectionClass;

class MigrationRunner
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function migrate(): void
    {
        foreach ($this->getEntityClasses() as $className) {
            $this->processEntity(new ReflectionClass($className));
        }
    }

    private function processEntity(ReflectionClass $reflection): void
    {
        $tableAttributes = $reflection->getAttributes(Table::class);
        if (empty($tableAttributes)) {
            return;
        }

        $tableName = $tableAttributes[0]->newInstance()->name;
        $this->ensureTableExists($tableName);

        foreach ($reflection->getProperties() as $property) {
            $this->processProperty($property, $tableName);
        }
    }

    private function ensureTableExists(string $tableName): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `$tableName` (id INT PRIMARY KEY AUTO_INCREMENT)");
    }


    private function processProperty($property, string $tableName): void
    {
        $attributes = $property->getAttributes(Column::class);
        if (!empty($attributes)) {
            $this->updateColumn($property->getName(), $attributes[0]->newInstance(), $tableName);
        }
    }

    private function updateColumn(string $columnName, object $attributeInstance, string $tableName): void
    {
        $sql = $this->columnDefinitionBuilder($columnName, $attributeInstance);

        if (!$this->columnExists($tableName, $columnName)) {
            $this->pdo->exec("ALTER TABLE $tableName ADD COLUMN $sql");
        } else {
            $this->pdo->exec("ALTER TABLE $tableName MODIFY $sql");
        }

        echo "Column `$columnName` updated in `$tableName`.\n";
    }

    private function columnExists(string $tableName, string $columnName): bool
    {
        $stmt = $this->pdo->prepare("SHOW COLUMNS FROM $tableName LIKE '$columnName'");
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    private function columnDefinitionBuilder(string $columnName, object $attributeInstance): string
    {
        $columnType = $attributeInstance->type->value;
        $sql = "`$columnName` $columnType";

        if ($attributeInstance->length) {
            $sql .= "({$attributeInstance->length})";
        }
        if (!$attributeInstance->nullable) {
            $sql .= " NOT NULL";
        }
        if ($attributeInstance->default !== null) {
            $sql .= " DEFAULT '{$attributeInstance->default}'";
        }


        return $sql;
    }

    private function getEntityClasses(): array
    {
        $entityPath = __DIR__ . '/../../Entity';
        $files = scandir($entityPath);

        return array_map(
            fn($file) => "App\\Entity\\" . pathinfo($file, PATHINFO_FILENAME),
            array_filter($files, fn($file) => str_ends_with($file, '.php'))
        );
    }
}
