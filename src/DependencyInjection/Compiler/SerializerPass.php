<?php

declare(strict_types=1);

namespace Ergnuor\ApiPlatformBundle\DependencyInjection\Compiler;

use Ergnuor\ApiPlatformBundle\DependencyInjection\BundleDetectorTrait;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\PriorityTaggedServiceTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\Reference;

class SerializerPass implements CompilerPassInterface
{
    use PriorityTaggedServiceTrait;
    use BundleDetectorTrait;

    public function process(ContainerBuilder $container)
    {
        if (!$this->hasErgnuorDomainModelBundle($container)) {
            return;
        }

        $this->configureDoctrineEntityNormalizer($container);

        $this->setNormalizers(
            $container,
            'ergnuor.api_platform.serializer',
            'ergnuor.api_platform.serializer'
        );
    }

    private function configureDoctrineEntityNormalizer(ContainerBuilder $container): void
    {
        $doctrineEntityNormalizer = $container->getDefinition('ergnuor.api_platform.serializer.normalizer.doctrine_entity');
        $doctrineEntityNormalizer->replaceArgument(
            7,
            new Reference('ergnuor.api_platform.serializer.normalizer.doctrine_entity.class_metadata_getter')
        );

        if (!$container->hasParameter('doctrine.entity_managers')) {
            $doctrineEntityNormalizer
                ->clearTag('ergnuor.api_platform.serializer');
        }
    }

    private function setNormalizers(
        ContainerBuilder $container,
        string $serializerServiceId,
        string $normalizersTag
    ): void {
        $normalizers = $this->findAndSortTaggedServices($normalizersTag, $container);

        if (!$normalizers) {
            throw new RuntimeException(
                sprintf(
                    'You must tag at least one service as "%s" to use the "%s" service.',
                    $normalizersTag,
                    $serializerServiceId
                )
            );
        }

        $serializerDefinition = $container->getDefinition($serializerServiceId);
        $serializerDefinition->replaceArgument(0, $normalizers);
    }
}
