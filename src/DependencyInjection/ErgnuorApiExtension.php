<?php

declare(strict_types=1);

namespace Ergnuor\ApiBundle\DependencyInjection;

use Ergnuor\Api\Persister\RestPersisterInterface;
use Ergnuor\Api\Repository\RestRepositoryInterface;
use Ergnuor\ApiBundle\CacheWarmer\MetadataCacheWarmer;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\PhpArrayAdapter;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class ErgnuorApiExtension extends Extension
{
    use BundleDetectorTrait;

    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->setContainerParameters($container, $config);

        $loader = new PhpFileLoader(
            $container,
            new FileLocator(\dirname(__DIR__) . '/Resources/config')
        );

        $loader->load('common.php');
        $loader->load('entity_manager.php');
        $loader->load('api_platform.php');
        $loader->load('metadata.php');
        $this->defineMetadataServices($container);

        if ($this->hasErgnuorDomainModelBundle($container)) {
            $loader->load('domain_model_serializer.php');
        } else {
            $loader->load('native_serializer.php');
        }


        $container->registerForAutoconfiguration(RestRepositoryInterface::class)
            ->addTag('ergnuor.api.repository');
        $container->registerForAutoconfiguration(RestPersisterInterface::class)
            ->addTag('ergnuor.api.persister');
    }

    private function defineMetadataServices(ContainerBuilder $container): void
    {
        $cacheId = 'ergnuor.api.mapping.class_metadata_cache';

        $cache = new Definition(ArrayAdapter::class);

        if (!$container->getParameter('kernel.debug')) {
            $phpArrayFile = '%kernel.cache_dir%/ergnuor/api_platform/metadata.php';

            $container->register('ergnuor.api.mapping.class_metadata_cache_warmer', MetadataCacheWarmer::class)
                ->setArguments([new Reference('ergnuor.api.entity_manager'), $phpArrayFile])
                ->addTag('kernel.cache_warmer', ['priority' => 1000]);

            $cache = new Definition(PhpArrayAdapter::class, [$phpArrayFile, $cache]);
        }

        $container->setDefinition($cacheId, $cache);
    }

    private function setContainerParameters(ContainerBuilder $container, array $config): void
    {
        $container->setParameter('ergnuor.api.entity_paths', $config['entity_paths']);
    }
}
