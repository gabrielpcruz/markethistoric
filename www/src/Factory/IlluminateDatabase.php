<?php

namespace App\Factory;

use Psr\Container\ContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class IlluminateDatabase implements FactoryInterface
{
    public function create(ContainerInterface $container)
    {
        $capsule = new Capsule();

        $database = $container->get('settings')->get('database.sqlite');

        $capsule->addConnection($database);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();
    }
}