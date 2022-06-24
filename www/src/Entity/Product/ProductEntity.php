<?php

namespace App\Entity\Product;

use App\Entity\Entity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Collection $history
 */
class ProductEntity extends Entity
{
    /**
     * @var string
     */
    protected $table = 'product';

    /**
     * @return HasMany
     */
    public function history(): HasMany
    {
        return $this->hasMany(ProductHistoryEntity::class);
    }
}