<?php

declare(strict_types=1);

namespace Support\Factory\Service;

use Interop\Container\ContainerInterface;
use Support\Renderer\Output;
use Support\Service\ConnectFourGame as ConnectFourInstance;
use Support\Service\RandomValue;
use Zend\ServiceManager\Factory\FactoryInterface;

final class ConnectFourGame implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): ConnectFourInstance
    {
        return new ConnectFourInstance(
            $container->get(Output::class),
            $container->get(RandomValue::class),
            ...$container->get('participants')
        );
    }
}