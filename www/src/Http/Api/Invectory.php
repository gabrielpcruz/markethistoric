<?php

namespace App\Http\Api;

use App\Entity\Inventory\InvectoryProductEntity;
use App\Entity\Inventory\InventoryEntity;
use App\Http\ControllerApi;
use App\Repository\Invectory\InvectoryProductRepository;
use App\Repository\Invectory\InvectoryRepository;
use App\Repository\Product\ProductRepository;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use ReflectionException;

class Invectory extends ControllerApi
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
        /** @var InvectoryRepository $productRepository */
        $invectoryRepository = $this->getRepositoryManager()->get(InvectoryRepository::class);

        return $this->responseJSON(
            $response,
            $invectoryRepository->all()->toArray()
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
        $invectory_id = $request->getAttribute('id');

        /** @var ProductRepository $productRepository */
        $invectoryRepository = $this->getRepositoryManager()->get(InvectoryRepository::class);

        $invectory = $invectoryRepository->findById($invectory_id);

        return $this->responseJSON(
            $response,
            $invectory->toArray()
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
    public function list(Request $request, Response $response, $params): Response
    {
        $invectory_id = $request->getAttribute('id');

        /** @var InvectoryRepository $productRepository */
        $invectoryRepository = $this->getRepositoryManager()->get(InvectoryRepository::class);

        /** @var InventoryEntity $invectory */
        $invectory = $invectoryRepository->findById($invectory_id);

        return $this->responseJSON(
            $response,
            $invectory->list->toArray()
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $params
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
     */
    public function post(Request $request, Response $response, $params): Response
    {
        $listInfo = json_decode($request->getBody()->getContents());

        $invectoryRepository = $this->getRepositoryManager()->get(InvectoryRepository::class);

        $invenctory = new InventoryEntity();
        $invenctory->setTitle($listInfo->name);
        $invectoryRepository->save($invenctory);

        foreach ($listInfo->products as $product_id) {
            $invenctoryProduct = new InvectoryProductEntity();
            $invenctoryProduct->setIdInvenctory($invenctory->getId());
            $invenctoryProduct->setIdProduct($product_id);
            $invenctoryProduct->save();
        }

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
    public function delete(Request $request, Response $response, $params): Response
    {
        $invectory_id = $request->getAttribute('id');

        /** @var InvectoryRepository $invectoryRepository */
        $invectoryRepository = $this->getRepositoryManager()->get(InvectoryRepository::class);

        /** @var InvectoryProductRepository $invectoryRepository */
        $invectoryProductRepository = $this->getRepositoryManager()->get(InvectoryProductRepository::class);

        $invectoryRepository->findById($invectory_id)->delete();
        $invectoryProductRepository->deleteById($invectory_id);

        return $this->responseJSON(
            $response,
            []
        );
    }
}