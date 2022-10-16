<?php

namespace App\Extension;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class AcmeDemoExtension implements ExtensionInterface
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     * @return mixed
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): mixed
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.xml');
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return 'http://www.example.com/symfony/schema/';
    }

    /**
     * @return false|string
     */
    public function getXsdValidationBasePath(): bool|string
    {
        return __DIR__.'/../Resources/config/'; //|| false
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return 'acme_demo';
    }
}