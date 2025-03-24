<?php

namespace App\Entity;

use App\Core\BaseEntity;
use App\Attributes\Table;

#[Table(name: "car")]
class Car extends BaseEntity {

    private ?int $id = null;

    private ?string $nom = null;

    public function setNom(?string $nom): void {
        $this->nom = $nom;
    }
    public function getNom(): ?string {
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

}
