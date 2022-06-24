<?php

use App\Http\Api\Product;
use Slim\App;

use App\Http\Site\Home;

return function (App $app) {
    // Site
    $app->get('/', [Home::class, 'index']);

    // Api
    $app->get('/v1/product', [Product::class, 'index']);
    $app->get('/v1/product/{id}', [Product::class, 'show']);
    $app->get('/v1/product/{id}/history', [Product::class, 'history']);
};
