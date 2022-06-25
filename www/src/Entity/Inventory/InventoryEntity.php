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
    /**
     * @var string
     */
    public string $title;

    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    protected $table = 'inventory';

    /**
     * @var string[]
     */
    protected $visible = [
        'id',
        'title',
        'created_at'
    ];

    /**
     * @param $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->attributes['title'] = $title;
    }

    /**
     * @return HasMany
     */
    public function list() : HasMany
    {
        return $this->hasMany(InvectoryProductEntity::class);
    }
}