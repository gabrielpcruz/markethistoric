<?php

use App\Http\Api\Invectory;
use App\Http\Api\Product;
use Slim\App;

use App\Http\Site\Home;

return function (App $app) {

    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });


    // Site
    $app->get('/', [Home::class, 'index']);

    // Api
    $app->get('/v1/product', [Product::class, 'index']);
    $app->get('/v1/product/{id}', [Product::class, 'show']);
    $app->get('/v1/product/{id}/history', [Product::class, 'history']);
    $app->post('/v1/product/{id}/history', [Product::class, 'addHistory']);

    $app->get('/v1/invenctory', [Invectory::class, 'index']);
    $app->get('/v1/invenctory/{id}', [Invectory::class, 'show']);
    $app->get('/v1/invenctory/{id}/list', [Invectory::class, 'list']);

    $app->post('/v1/invenctory', [Invectory::class, 'post']);
    $app->put('/v1/invenctory/{id}', [Invectory::class, 'put']);
    $app->delete('/v1/invenctory/{id}', [Invectory::class, 'delete']);


    $app->put('/v1/invenctory/cart/{product_inventory_id}', [Invectory::class, 'putOnCart']);
    $app->delete('/v1/invenctory/cart/{product_inventory_id}', [Invectory::class, 'deleteFromCart']);
};
