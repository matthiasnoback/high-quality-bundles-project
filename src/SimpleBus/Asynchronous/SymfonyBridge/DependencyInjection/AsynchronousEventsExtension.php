<?php

namespace SimpleBus\Asynchronous\SymfonyBridge\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class AsynchronousEventsExtension extends ConfigurableExtension implements PrependExtensionInterface
{
    /**
     * Allow an extension to prepend the extension configurations.
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig(
            'jms_serializer',
            [
                'metadata' => [
                    'directories' => [
                        'AsynchronousEvents' => [
                            'namespace_prefix' => 'SimpleBus\\Asynchronous',
                            'path' => __DIR__ . '/../Resources/jms_serializer'
                        ]
                    ]
                ]
            ]
        );
    }

    /**
     * @var string
     */
    private $alias;

    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function getConfiguration(array $config, ContainerBuilder $container)
    {
        return new AsynchronousEventsBundleConfiguration($this->alias);
    }

    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('asynchronous_event_bus.yml');
        $loader->load('serialization.yml');

        if ($mergedConfig['jms_serializer']['enabled']) {
            $loader->load('jms_serializer.yml');
        }

        if ($mergedConfig['rabbit_mq']['enabled']) {
            $loader->load('rabbit_mq.yml');
            $container->setAlias('simple_bus.asynchronous.amqp_message_producer', $mergedConfig['rabbit_mq']['producer_service_id']);
        }
    }

}
