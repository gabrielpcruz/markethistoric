<?php

namespace App\Repository\Invectory;

use App\Entity\Inventory\InvectoryProductEntity;
use App\Repository\Repository;
use Illuminate\Database\Eloquent\Builder;

class InvectoryProductRepository extends Repository
{
    public function getEntityClass(): string
    {
        return InvectoryProductEntity::class;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteById($id): int
    {
        return $this
            ->queryWhere(['inventory_entity_id' => $id])
            ->delete();
    }
}