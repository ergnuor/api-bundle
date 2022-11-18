<?php
declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Ergnuor\ApiPlatform\EntityManager\RestEntityManager;
use Ergnuor\ApiPlatform\EntityManager\RestEntityManagerInterface;

return static function (ContainerConfigurator $container) {

    $container->services()
        ->set('ergnuor.api_platform.entity_manager', RestEntityManager::class)
            ->args([
                service('ergnuor.api_platform.mapping.class_metadata_factory'),
                tagged_locator('ergnuor.api_platform.repository'),
                tagged_locator('ergnuor.api_platform.persister'),
            ])

        ->alias(RestEntityManagerInterface::class, 'ergnuor.api_platform.entity_manager')

    ;
};
