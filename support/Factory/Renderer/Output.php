<?php

declare(strict_types=1);

namespace Support\Factory\Renderer;

use Interop\Container\ContainerInterface;
use Support\Renderer\Output as OutputClass;
use Zend\ServiceManager\Factory\FactoryInterface;

final class Output implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): OutputClass
    {
        return new OutputClass();
    }
}