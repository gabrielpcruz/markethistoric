<?php

namespace App\Repository\Invectory;

use App\Entity\Inventory\InventoryEntity;
use App\Repository\Repository;

class InvectoryRepository extends Repository
{
    public function getEntityClass(): string
    {
        return InventoryEntity::class;
    }
}