<?php

namespace App\Core;

use App\Attributes\Table;
use App\Core\Database;
use ReflectionClass;

abstract class BaseEntity {
    public static function getOneById(int $id): ?static {
        $pdo = Database::connect();
        $reflection = new ReflectionClass(static::class);
        $attributes = $reflection->getAttributes(Table::class);

        if (empty($attributes)) {
            throw new \Exception("L'entité " . static::class . " n'a pas d'attribut #[Table]");
        }

        $tableName = $attributes[0]->newInstance()->name;

        // Sécurisation du nom de table (évite injection SQL)
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $tableName)) {
            throw new \Exception("Nom de table invalide : $tableName");
        }

        // Préparation et exécution sécurisée
        $stmt = $pdo->prepare("SELECT * FROM `$tableName` WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        // Retourne une instance de l'entité ou null
        return $stmt->fetchObject(static::class) ?: null;
    }
}
