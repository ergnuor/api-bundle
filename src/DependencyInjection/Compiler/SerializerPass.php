<?php

declare(strict_types=1);

namespace Ergnuor\ApiBundle\DependencyInjection\Compiler;

use Ergnuor\ApiBundle\DependencyInjection\BundleDetectorTrait;
use Ergnuor\SerializerBundle\DependencyInjection\Compiler\SerializerTrait;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class SerializerPass implements CompilerPassInterface
{
    use SerializerTrait;
    use BundleDetectorTrait;

    public function process(ContainerBuilder $container)
    {
        if (!$this->hasErgnuorDomainModelBundle($container)) {
            return;
        }

        $this->configureDoctrineEntityNormalizer($container);

        $this->setNormalizers(
            $container,
            'ergnuor.api.serializer',
            'ergnuor.api.serializer.normalizer'
        );
    }

    private function configureDoctrineEntityNormalizer(ContainerBuilder $container): void
    {
        $doctrineEntityNormalizer = $container->getDefinition('ergnuor.api.serializer.normalizer.doctrine_entity');

        if (!$container->hasParameter('doctrine.entity_managers')) {
            $doctrineEntityNormalizer
                ->clearTag('ergnuor.api.serializer.normalizer');
        }
    }
}
