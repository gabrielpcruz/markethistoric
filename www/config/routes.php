<?php

use App\Http\Api\Invectory;
use App\Http\Api\Product;
use Slim\App;

use App\Http\Site\Home;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });


    // Site
    $app->get('/', [Home::class, 'index']);

    $app->group('/v1', function (RouteCollectorProxy $v1) {

        $v1->group('/product', function (RouteCollectorProxy $product) {
            $product->get('', [Product::class, 'index']);
            $product->post('', [Product::class, 'add']);
            $product->put('/{id}', [Product::class, 'edit']);


            $product->get('/{id}', [Product::class, 'show']);
            $product->get('/{id}/history', [Product::class, 'history']);
            $product->post('/{id}/history', [Product::class, 'addHistory']);
        });

        $v1->group('/invenctory', function (RouteCollectorProxy $invenctory) {
            $invenctory->get('', [Invectory::class, 'index']);
            $invenctory->post('', [Invectory::class, 'post']);

            $invenctory->get('/{id}', [Invectory::class, 'show']);
            $invenctory->put('/{id}', [Invectory::class, 'put']);
            $invenctory->delete('/{id}', [Invectory::class, 'delete']);

            $invenctory->get('/{id}/list', [Invectory::class, 'list']);

            $invenctory->put('/cart/{product_inventory_id}', [Invectory::class, 'putOnCart']);
            $invenctory->delete('/cart/{product_inventory_id}', [Invectory::class, 'deleteFromCart']);
        });
    });
};
