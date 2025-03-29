<?php

namespace App\Attributes;

use Attribute;
use App\Enum\ColumnType;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Column {
    public function __construct(
        public ColumnType $type,
        public ?int $length = null,
        public bool $nullable = false,
        public ?string $default = null
    ) {}
}
