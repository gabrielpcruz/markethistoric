<?php

namespace App\Http\Api;

use App\Http\ControllerApi;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;

class Product extends ControllerApi
{
    public function show(Request $request, Response $response): Response
    {
        $result = DB::table('arroz AS a')
        ->select()->get();

        return $this->responseJSON($response, $result->toArray());
    }
}