<?php

namespace App\Entity;

use App\Core\BaseEntity;
use App\Attributes\Column;
use App\Attributes\Table;

#[Table(name: "car")]
class Car extends BaseEntity {
    #[Column(type: "VARCHAR", length: 100, nullable: false)]
    private string $nom;

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }
    public function getNom(): string {
        return $this->nom;
    }

}
