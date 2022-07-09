<?php

namespace App\Entity\Product;

use App\Entity\Entity;
use DateTime;
use DateTimeImmutable;
use Exception;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductHistoryEntity extends Entity
{
    /**
     * @var string
     */
    protected $table = 'product_history';

    /**
     * @var string[]
     */
    protected $visible = [
        'id',
        'product_entity_id',
        'price',
        'description',
        'created_at'
    ];

    /**
     * @param $id
     * @return void
     */
    public function setProductId($id)
    {
        $this->attributes['product_entity_id'] = $id;
    }

    /**
     * @param $price
     * @return void
     */
    public function setPrice($price)
    {
        $this->attributes['price'] = $price;
    }

    /**
     * @param $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
    }

    /**
     * @return HasOne
     */
    public function product(): HasOne
    {
        return $this->hasOne(ProductEntity::class, 'id', 'product_entity_id');
    }

    /**
     * @return array
     * @throws Exception
     */
    public function attributesToArray(): array
    {
        return [
            "id" => $this->id,
            "product_id" => $this->product_entity_id,
            "price" => $this->price,
            "description" => $this->description,
            "data" => (new DateTime($this->created_at))->format('d/m/Y'),
            "product_name" => $this->product->name,
        ];
    }
}