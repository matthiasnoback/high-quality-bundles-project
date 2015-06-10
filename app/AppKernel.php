<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Matthias\Bundle\ConsoleCommandGeneratorBundle\MatthiasConsoleCommandGeneratorBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Matthias\SymfonyConsoleForm\Bundle\SymfonyConsoleFormBundle(),
            new SimpleBus\SymfonyBridge\SimpleBusCommandBusBundle(),
            new SimpleBus\SymfonyBridge\SimpleBusEventBusBundle(),
            new SimpleBus\SymfonyBridge\DoctrineOrmBridgeBundle(),
//            new Traditional\Bundle\UserBundle\TraditionalUserBundle(),
            new Derp\Bundle\ERBundle\DerpERBundle(),
            new OldSound\RabbitMqBundle\OldSoundRabbitMqBundle(),
            new SimpleBus\JMSSerializerBundleBridge\SimpleBusJMSSerializerBundleBridgeBundle(),
            new SimpleBus\AsynchronousBundle\SimpleBusAsynchronousBundle(),
            new SimpleBus\RabbitMQBundleBridge\SimpleBusRabbitMQBundleBridgeBundle()
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
