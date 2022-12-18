<?php

declare(strict_types=1);

namespace Ergnuor\ApiBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MetadataPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $classMetadataFactoryAdapterDefinition = $container->getDefinition('ergnuor.api.mapping.class_metadata_factory_adapter');
        $classMetadataFactoryAdapterDefinition->replaceArgument(
            0,
            $container->getParameter('ergnuor.api.entity_paths')
        );
    }
}
