<?php

namespace Derp\Infrastructure\Symfony;

use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class DerpERExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/Resources/config'));
        $loader->load('services.yml');
    }

    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig('twig', [
            'paths' => [
                '%kernel.root_dir%/../src/Derp/Infrastructure/Web/views' => 'Derp'
            ]
        ]);
    }
}
