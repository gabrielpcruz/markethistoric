<?php

namespace App\Entity\Product;

use App\Entity\Entity;
use App\Entity\Inventory\InvectoryProductEntity;
use App\Entity\Inventory\InventoryEntity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * @return HasMany
     */
    public function product(): HasMany
    {
        return $this->hasMany(InvectoryProductEntity::class);
    }
}