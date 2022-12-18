<?php
declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Ergnuor\Api\ApiPlatform\Metadata\Resource\Factory\UriTemplateResourceMetadataCollectionFactory;
use Ergnuor\Api\ApiPlatform\State\RestRepositoryStateProvider;
use Ergnuor\Api\ApiPlatform\State\RestRepositoryStateProcessor;

return static function (ContainerConfigurator $container) {

    $container->services()
        ->set(RestRepositoryStateProvider::class, RestRepositoryStateProvider::class)
            ->args([
                service('ergnuor.api.entity_manager'),
                service(\ApiPlatform\State\Pagination\Pagination::class),
            ])
            ->tag('api_platform.state_provider')

        ->alias('ergnuor.api.api_platform.state.provider.rest_repository', RestRepositoryStateProvider::class)

        ->set(RestRepositoryStateProcessor::class, RestRepositoryStateProcessor::class)
            ->args([
                service('ergnuor.api.entity_manager'),
            ])
            ->tag('api_platform.state_processor')

        ->alias('ergnuor.api.api_platform.state.processor.rest_repository', RestRepositoryStateProcessor::class)

        ->set('ergnuor.api.api_platform.metadata.resource.metadata_collection_factory.uri_template_decorator', UriTemplateResourceMetadataCollectionFactory::class)
            ->decorate('api_platform.metadata.resource.metadata_collection_factory.uri_template')
            ->args([
                service('.inner'),
                service('ergnuor.api.entity_manager'),
            ])
    ;
};
