<?php

namespace App\Repository\Product;

use App\Entity\Product\ProductHistory;
use App\Repository\Repository;

class ProductHistoryRepository extends Repository
{
    /**
     * @return string
     */
    public function getEntityClass(): string
    {
        return ProductHistory::class;
    }
}