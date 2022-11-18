<?php
declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Ergnuor\ApiPlatform\Mapping\ClassMetadataFactoryAdapter;
use Ergnuor\Mapping\ClassMetadataFactory;

return static function (ContainerConfigurator $container) {

    $container->services()
        ->set('ergnuor.api_platform.mapping.class_metadata_factory_adapter', ClassMetadataFactoryAdapter::class)
            ->args([
                []
            ])

        ->set('ergnuor.api_platform.mapping.class_metadata_factory', ClassMetadataFactory::class)
            ->args([
                service('ergnuor.api_platform.mapping.class_metadata_factory_adapter')
            ])
            ->call('setCache', [service('ergnuor.api_platform.mapping.class_metadata_cache')])
    ;
};
