<?php

namespace App\Core\Entity;

use App\Enum\ColumnType;

class PropertyCreator
{

    public function new(): void
    {
        echo "\033[33mNom de la nouvelle propriétée : \n\033[0m";
        $handle = fopen("php://stdin", "r");
        $name = trim(fgets($handle));
        fclose($handle);

        $type = $this->propertyType();

        $length = null;
        if ($type === ColumnType::VARCHAR->value) {
            $length = $this->propertyLength();
        }

        echo "\033[33mLa propriétée peut être null ? (y / n) : \n\033[0m";
        $handle = fopen("php://stdin", "r");
        $input = trim(fgets($handle));
        $isNullable = $input === 'y';
        fclose($handle);

        $this->updateCarProperties($name, $type, $length, $isNullable);
        $this->new();
    }

    private function updateCarProperties($name, $type, $length, $isNullable): void
    {
        $filePath = 'src/Entity/Car.php';
        $file = file_get_contents($filePath);

        $propType = $type === ColumnType::VARCHAR->value ? 'string' : strtolower($type);
        $isNullable = $isNullable ? "true" : "false";

        $length = $length ? 'length: ' . $length . ',' : '';

        $propertyDeclaration = "\n\t#[Column(type: ColumnType::{$type}, {$length} nullable: {$isNullable})]\n\tpublic ?{$propType} \${$name} = null;\n\n";

        $file = str_replace("}", $propertyDeclaration . '}', $file);
        file_put_contents($filePath, $file);

        echo "\033[32mPropriétée ajoutée avec succès.\n\n\033[0m";
    }

    private function propertyLength(): int
    {
        echo "\033[33mLongueur de la propriété : \n\033[0m";
        $handle = fopen("php://stdin", "r");
        $length = (int)trim(fgets($handle));
        fclose($handle);

        if ($length <= 0) {
            $this->propertyLength();
        }

        return $length;
    }

    private function propertyType(): string
    {
        echo "\033[33m\nType de la propriété. ('?' liste des types.) : \n\033[0m";
        $handle = fopen("php://stdin", "r");
        $choice = strtoupper(trim(fgets($handle)));
        fclose($handle);

        if ($choice === '?') {
            foreach (ColumnType::types() as $type) {
                echo "\n" . $type;
            }
        }

        if (!in_array($choice, ColumnType::types())) {
            $this::propertyType();
        }

        return $choice;
    }
}