<?php

use App\Http\Api\Product;
use Slim\App;


return function (App $app) {
    // Api

    $app->get('/', [Product::class, 'show']);
};
