<?php

namespace App\Entity\Inventory;

use App\Entity\Entity;
use App\Entity\Product\ProductEntity;
use Illuminate\Database\Eloquent\Relations\HasOne;


class InvectoryProductEntity extends Entity
{
    /**
     * @var string
     */
    protected $table = 'inventory_product';

    /**
     * @var string[]
     */
    protected $visible = [
        'inventory_entity_id',
        'product_entity_id',
        'checked',
    ];

    /**
     * @return HasOne
     */
    public function product(): HasOne
    {
        return $this->hasOne(ProductEntity::class, 'id', 'product_entity_id');
    }

    /**
     * @return array
     */
    public function attributesToArray(): array
    {
        return [
            "inventory_entity_id" => $this->inventory_entity_id,
            "product_entity_id" => $this->product_entity_id,
            "product_name" => $this->product->name,
            "checked" => $this->checked,
        ];
    }
}