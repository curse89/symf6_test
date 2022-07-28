<?php

namespace App\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\RouteCollection;

class AdvancedLoader extends Loader
{

    /**
     * @inheritDoc
     */
    public function load(mixed $resource, string $type = null)
    {
        $routes = new RouteCollection();

        $resource = 'test_routes.yaml';
        $type = 'yaml';

        $importedRoutes = $this->import($resource, $type);

        $routes->addCollection($importedRoutes);
        return $routes;
    }

    /**
     * @inheritDoc
     */
    public function supports(mixed $resource, string $type = null): bool
    {
        return 'advanced_custom' === $type;
    }
}