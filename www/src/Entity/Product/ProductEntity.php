<?php

namespace App\Entity\Product;

use App\Entity\Entity;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductEntity extends Entity
{
    protected $table = 'product';

    /**
     * @return HasMany
     */
    public function history(): HasMany
    {
        return $this->hasMany(ProductHistory::class);
    }
}