<?php

namespace App\Routing;

use Symfony\Bundle\FrameworkBundle\Routing\RouteLoaderInterface;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class CustomRouteLoader extends Loader
    implements RouteLoaderInterface
{
    private bool $isLoaded = false;

    public function load(mixed $resource, string $type = null): RouteCollection
    {
        if (true === $this->isLoaded) {
            throw new \RuntimeException('Загрузчик уже загружен');
        }

        $routes = new RouteCollection();
        $path = '/custom/{parameter}';
        $defaults = [
            '_controller' => 'App\Controller\CustomController::custom',
        ];
        $requirements = [
            'parameter' => '\d+',
        ];
        $route = new Route($path, $defaults, $requirements);

        $routeName = 'customRoute';
        $routes->add($routeName, $route);

        $this->isLoaded = true;

        return $routes;
    }

    public function supports(mixed $resource, string $type = null): bool
    {
        return 'custom' === $type;
    }
}