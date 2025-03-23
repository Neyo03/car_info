<?php

namespace App\Core;

require_once __DIR__ . '/../../config/Database.php';

use ReflectionClass;

abstract class BaseEntity {
    public static function getOneById($id): array {
        $pdo = Database::connect();
        $reflection = new ReflectionClass(static::class);
        $tableName = strtolower($reflection->getShortName());

        $stmt = $pdo->query("SELECT * FROM :tableName WHERE id = :id");
        $stmt->bindParam(':tableName', $tableName);
        $stmt->bindParam(':id', $id);

        return $stmt->fetch(\PDO::FETCH_CLASS, static::class);
    }
}
