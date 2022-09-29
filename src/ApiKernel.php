<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class ApiKernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getProjectDir(): string
    {
        return \dirname(__DIR__);
    }

    public function getCacheDir(): string
    {
        return $this->getProjectDir().'/var/cache/api/'.$this->environment;
    }

    public function getLogDir(): string
    {
        return $this->getProjectDir().'/var/log/api';
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../config/api/{packages}/*.yaml');
        $container->import('../config/api/{packages}/'.$this->environment.'/*.yaml');

        if (is_file(\dirname(__DIR__).'/config/api/services.yaml')) {
            $container->import('../config/api/services.yaml');
            $container->import('../config/api/{services}_'.$this->environment.'.yaml');
        } else {
            $container->import('../config/api/{services}.php');
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('../config/api/{routes}/'.$this->environment.'/*.yaml');
        $routes->import('../config/api/{routes}/*.yaml');
        // ... load only the config routes strictly needed for the API
    }

    // If you need to run some logic to decide which bundles to load,
    // you might prefer to use the registerBundles() method instead
    private function getBundlesPath(): string
    {
        // load only the bundles strictly needed for the API
        return $this->getProjectDir().'/config/api_bundles.php';
    }
}
