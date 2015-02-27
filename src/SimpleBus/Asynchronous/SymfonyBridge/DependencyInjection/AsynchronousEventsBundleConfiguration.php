<?php

namespace SimpleBus\Asynchronous\SymfonyBridge\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class AsynchronousEventsBundleConfiguration implements ConfigurationInterface
{
    /**
     * @var string
     */
    private $alias;

    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root($this->alias);

        $rootNode
            ->children()
                ->arrayNode('rabbit_mq')
                    ->canBeEnabled()
                    ->children()
                        ->scalarNode('producer_service_id')
                            ->isRequired()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('jms_serializer')
                    ->canBeEnabled()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
