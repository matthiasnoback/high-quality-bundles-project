<?php

namespace Traditional\Infrastructure\Configuration;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class TraditionalUserBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new UserExtension();
    }

    public function build(ContainerBuilder $container)
    {
        $xmlPath = __DIR__ . '/../Persistence/DoctrineORM/Mapping';
        $namespacePrefix = 'Traditional\Core\Model';

        $compilerPass = DoctrineOrmMappingsPass::createXmlMappingDriver(
            array(
                $xmlPath => $namespacePrefix
            )
        );
        $container->addCompilerPass($compilerPass);
    }
}
