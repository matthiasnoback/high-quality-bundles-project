<?php

namespace SimpleBus\Asynchronous\SymfonyBridge;

use SimpleBus\Asynchronous\SymfonyBridge\DependencyInjection\Compiler\ConfigureNameResolvingStrategy;
use SimpleBus\Asynchronous\SymfonyBridge\DependencyInjection\AsynchronousEventsExtension;
use SimpleBus\SymfonyBridge\DependencyInjection\Compiler\ConfigureMiddlewares;
use SimpleBus\SymfonyBridge\DependencyInjection\Compiler\RegisterSubscribers;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AsynchronousEventsBundle extends Bundle
{
    /**
     * @var string
     */
    private $configurationAlias;

    public function __construct($configurationAlias = 'asynchronous_events')
    {
        $this->configurationAlias = $configurationAlias;
    }

    public function getContainerExtension()
    {
        return new AsynchronousEventsExtension($this->configurationAlias);
    }

    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ConfigureNameResolvingStrategy());

        $container->addCompilerPass(
            new ConfigureMiddlewares('simple_bus.asynchronous.event_bus', 'asynchronous_event_bus_middleware')
        );

        $container->addCompilerPass(
            new RegisterSubscribers(
                'simple_bus.asynchronous.event_bus.event_subscribers_collection',
                'event_subscriber',
                'subscribes_to'
            )
        );
    }
}
