<?php

namespace App;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class CommandBus implements ServiceSubscriberInterface
{
    private $locator;

    public function __construct(ContainerInterface $locator)
    {
        $this->locator = $locator;
    }

    public static function getSubscribedServices(): array
    {
        return [
            'App\FooCommand' => FooHandler::class,
            'App\BarCommand' => BarHandler::class,
            'logger' => LoggerInterface::class,
        ];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(Command $command)
    {
        $commandClass = get_class($command);

        if ($this->locator->has($commandClass)) {
            $handler = $this->locator->get($commandClass);

            return $handler->handle($command);
        }
    }
}