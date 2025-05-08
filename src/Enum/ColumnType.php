<?php

namespace App\Enum;

enum ColumnType: string {
    case INT = 'INT';
    case VARCHAR = 'VARCHAR';
    case TEXT = 'TEXT';
    case BOOLEAN = 'BOOLEAN';
    case DATETIME = 'DATETIME';
    case DECIMAL = 'DECIMAL';

    public static function types(): array
    {
        return array_column(ColumnType::cases(), 'value');
    }
}