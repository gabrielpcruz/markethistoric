<?php

namespace App\Http;

use App\Repository\RepositoryManager;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;

abstract class Controller
{
    /**
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function getRepositoryManager(): RepositoryManager
    {
        return $this->container->get(RepositoryManager::class);
    }

    /**
     * @param ResponseInterface $response
     * @param array $data
     * @param int $status
     * @return ResponseInterface
     */
    public function responseJSON(
        ResponseInterface $response,
        array             $data,
        int               $status = 200
    ): ResponseInterface
    {
        $json = json_encode($data, JSON_PRETTY_PRINT);

        $response->getBody()->write($json);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->withStatus($status);
    }
}