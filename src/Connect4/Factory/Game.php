<?php

declare(strict_types=1);

namespace App\Connect4\Factory;

use Interop\Container\ContainerInterface;
use Support\Renderer\Output;
use Support\Service\RandomValue;
use Zend\ServiceManager\Factory\FactoryInterface;

final class Game implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new \App\Connect4\Service\Game(
            $container->get(Output::class),
            $container->get(RandomValue::class),
            ...$container->get('participants')
        );
    }
}