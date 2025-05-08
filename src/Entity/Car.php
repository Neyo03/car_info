<?php

namespace App\Entity;

use App\Attributes\Column;
use App\Attributes\Table;
use App\Core\Entity\BaseEntity;
use App\Enum\ColumnType;

#[Table(name: "car")]
class Car extends BaseEntity
{

    #[Column(type: ColumnType::INT, nullable: false)]
    public ?int $id = null;


}
