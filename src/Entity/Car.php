<?php

namespace App\Entity;

use App\Attributes\Column;
use App\Attributes\Table;
use App\Core\Entity\BaseEntity;
use App\Enum\ColumnType;

#[Table(name: "car")]
class Car extends BaseEntity {

    #[Column(type: ColumnType::INT, nullable: false)]
    private ?int $id = null;

    #[Column(type: ColumnType::VARCHAR, length: 254, nullable: false)]
    private ?string $nom = null;

    #[Column(type: ColumnType::VARCHAR, length: 255, nullable: false)]
    private ?string $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function getType(): ?string
    {
        return $this->type;
    }
}
