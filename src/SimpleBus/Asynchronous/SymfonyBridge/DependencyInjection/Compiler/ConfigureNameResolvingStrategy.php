<?php

namespace SimpleBus\Asynchronous\SymfonyBridge\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ConfigureNameResolvingStrategy implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $container->setAlias(
            'simple_bus.asynchronous.event_bus.event_name_resolver',
            'simple_bus.event_bus.event_name_resolver'
        );
    }
}
