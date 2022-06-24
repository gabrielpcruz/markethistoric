<?php

namespace App\Http\Site;

use App\Entity\Product\ProductEntity;
use App\Http\ControllerSite;
use App\Repository\Product\ProductRepository;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use ReflectionException;

class Home extends ControllerSite
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
     */
    public function index(Request $request, Response $response): Response
    {
        $repository = $this->getRepositoryManager()->get(ProductRepository::class);

        /** @var ProductEntity $product */
        $product = $repository->findById(1);

        return $this->responseJSON(
            $response,
            $product->history()->get()->toArray()
        );
    }
}