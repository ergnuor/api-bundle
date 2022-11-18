<?php

declare(strict_types=1);

namespace Ergnuor\ApiPlatformBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MetadataPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $classMetadataFactoryAdapterDefinition = $container->getDefinition('ergnuor.api_platform.mapping.class_metadata_factory_adapter');
        $classMetadataFactoryAdapterDefinition->replaceArgument(
            0,
            $container->getParameter('ergnuor.api_platform.entity_paths')
        );
    }
}
