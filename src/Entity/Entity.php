<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->attributes['id'];
    }
}