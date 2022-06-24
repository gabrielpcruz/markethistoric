<?php

namespace App\Entity\Inventory;

use App\Entity\Entity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Collection $list
 */
class InventoryEntity extends Entity
{
    protected $table = 'inventory';

    /**
     * @return HasMany
     */
    public function list() : HasMany
    {
        return $this->hasMany(InvectoryProductEntity::class);
    }
}