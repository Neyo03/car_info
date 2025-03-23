<?php

namespace App\Attributes;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class Column {
    public function __construct(
        public string $type = "VARCHAR",
        public int $length = 255,
        public bool $unique = false,
        public bool $nullable = false
    ) {}
}
