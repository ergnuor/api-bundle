<?php
declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Ergnuor\ApiPlatform\DataPersister\RestPersisterDataPersister;
use Ergnuor\ApiPlatform\DataProvider\RestRepositoryDataProvider;

return static function (ContainerConfigurator $container) {

    $container->services()
        ->set('ergnuor.api_platform.data_provider.rest_repository', RestRepositoryDataProvider::class)
            ->args([
                service('ergnuor.api_platform.entity_manager'),
                service('ApiPlatform\Core\DataProvider\Pagination'),
            ])
            ->tag('api_platform.item_data_provider')
            ->tag('api_platform.collection_data_provider')
            ->tag('api_platform.subresource_data_provider')

        ->set('ergnuor.api_platform.data_persister.rest_repository', RestPersisterDataPersister::class)
            ->args([
                service('ergnuor.api_platform.entity_manager'),
            ])
            ->tag('api_platform.data_persister')

    ;
};
