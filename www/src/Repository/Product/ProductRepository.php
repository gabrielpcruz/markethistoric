<?php

namespace App\Repository\Product;

use App\Entity\Product\ProductEntity;
use App\Repository\Repository;

class ProductRepository extends Repository
{
    public function getEntityClass(): string
    {
        return ProductEntity::class;
    }
}