<?php

namespace App\Http\Api;

use App\Entity\Product\ProductEntity;
use App\Entity\Product\ProductHistoryEntity;
use App\Http\ControllerApi;
use App\Repository\Product\ProductRepository;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use ReflectionException;

class Product extends ControllerApi
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
        /** @var ProductRepository $productRepository */
        $productRepository = $this->getRepositoryManager()->get(ProductRepository::class);

        return $this->responseJSON(
            $response,
            $productRepository->all()->toArray()
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $params
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
     */
    public function show(Request $request, Response $response, $params): Response
    {
        $product_id = $request->getAttribute('id');

        /** @var ProductRepository $productRepository */
        $productRepository = $this->getRepositoryManager()->get(ProductRepository::class);

        $product = $productRepository->findById($product_id);

        return $this->responseJSON(
            $response,
            $product->toArray()
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $params
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
     */
    public function history(Request $request, Response $response, $params): Response
    {
        $product_id = $request->getAttribute('id');

        /** @var ProductRepository $productRepository */
        $productRepository = $this->getRepositoryManager()->get(ProductRepository::class);

        /** @var ProductEntity $product */
        $product = $productRepository->findById($product_id);

        return $this->responseJSON(
            $response,
            $product->history->toArray()
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $params
     * @return Response
     */
    public function addHistory(Request $request, Response $response, $params): Response
    {
        $product_id = $request->getAttribute('id');
        $history = json_decode($request->getBody()->getContents());

        $producHistory = new ProductHistoryEntity();
        $producHistory->setProductId($product_id);
        $producHistory->setPrice($history->price);
        $producHistory->setDescription($history->description);

        $producHistory->save();

        return $this->responseJSON(
            $response,
            []
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $params
     * @return Response
     */
    public function add(Request $request, Response $response, $params): Response
    {
        $productForm = json_decode($request->getBody()->getContents());

        if (!isset($productForm->name)) {
            return $this->responseJSON(
                $response,
                [], 500
            );
        }

        $product = new ProductEntity();
        $product->setName($productForm->name);
        $product->save();

        return $this->responseJSON(
            $response,
            []
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $params
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
     */
    public function edit(Request $request, Response $response, $params): Response
    {
        $product_id = $request->getAttribute('id');
        $productForm = json_decode($request->getBody()->getContents());

        if (!isset($productForm->name)) {
            return $this->responseJSON(
                $response,
                [], 500
            );
        }

        $productRepository = $this->getRepositoryManager()->get(ProductRepository::class);

        /** @var ProductEntity $product */
        $product = $productRepository->findById($product_id);

        if (!$product) {
            return $this->responseJSON(
                $response,
                [], 404
            );
        }

        $product->setName($productForm->name);
        $product->save();

        return $this->responseJSON(
            $response,
            []
        );
    }
}