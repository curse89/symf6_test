<?php

namespace App;

use App\Service\KernelService;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel implements CompilerPassInterface
{
    use MicroKernelTrait;

    public function process(ContainerBuilder $container): void
    {
        // in this method you can manipulate the service container:
        // for example, changing some container service:

        $a = $container->hasDefinition('transformer');
        $b = $container->has('testalias');
        $c = $container->hasDefinition('testalias');
        $container->getDefinition('transformer')->setPublic(true);
        $definition = $container->findDefinition('testalias');

        $newDef = new Definition(KernelService::class);
        $container->setDefinition('kernel_service', $newDef);

        #$container->register('kernel_service', KernelService::classs);
        // or processing tagged services:
        foreach ($container->findTaggedServiceIds('trans') as $id => $tags) {
            $a = 1;
            $b = $container->getDefinition($id);
        }
    }
}
