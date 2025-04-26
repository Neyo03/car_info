<?php

namespace App\Core\Entity;

use App\Attributes\Table;
use App\Core\Database\Database;
use Exception;
use PDO;
use ReflectionClass;

abstract class BaseEntity {

    public function __call(string $method, array $arguments) {
            $property = lcfirst(substr($method, 3));
            if (property_exists($this, $property)) {
                $value = $this->$property;
                return is_string($value) ? htmlspecialchars($value, ENT_QUOTES, 'UTF-8') : $value;
            }
        throw new Exception("Méthode '$method' introuvable dans la classe " . static::class);
    }
    public static function getOneById(int $id): ?static {
        $pdo = Database::connect();
        $reflection = new ReflectionClass(static::class);
        $attributes = $reflection->getAttributes(Table::class);

        if (empty($attributes)) {
            throw new Exception("L'entité " . static::class . " n'a pas d'attribut #[Table]");
        }

        $tableName = $attributes[0]->newInstance()->name;

        if (!preg_match('/^[a-zA-Z0-9_]+$/', $tableName)) {
            throw new Exception("Nom de table invalide : $tableName");
        }

        $stmt = $pdo->prepare("SELECT * FROM `$tableName` WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchObject(static::class) ?: null;
    }


}
