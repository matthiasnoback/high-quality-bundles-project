<?php

namespace Traditional\Bundle\UserBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Traditional\Bundle\UserBundle\DependencyInjection\UserExtension;
use Traditional\User\Domain\Model\Mapping;

class TraditionalUserBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new UserExtension();
    }

    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createAnnotationMappingDriver(
                [Mapping::NAMESPACE_PREFIX],
                [Mapping::DIRECTORY]
            )
        );
    }
}
