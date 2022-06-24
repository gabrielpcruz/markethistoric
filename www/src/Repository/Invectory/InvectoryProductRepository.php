<?php

namespace App\Repository\Invectory;

use App\Entity\Inventory\InvectoryProductEntity;
use App\Repository\Repository;

class InvectoryProductRepository extends Repository
{
    public function getEntityClass(): string
    {
        return InvectoryProductEntity::class;
    }
}