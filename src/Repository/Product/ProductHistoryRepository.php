<?php

namespace App\Repository\Product;

use App\Entity\Product\ProductHistoryEntity;
use App\Repository\Repository;

class ProductHistoryRepository extends Repository
{
    /**
     * @return string
     */
    public function getEntityClass(): string
    {
        return ProductHistoryEntity::class;
    }
}