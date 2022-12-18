<?php
declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Ergnuor\Api\EntityManager\RestEntityManager;
use Ergnuor\Api\EntityManager\RestEntityManagerInterface;

return static function (ContainerConfigurator $container) {

    $container->services()
        ->set('ergnuor.api.entity_manager', RestEntityManager::class)
            ->args([
                service('ergnuor.api.mapping.class_metadata_factory'),
                tagged_locator('ergnuor.api.repository'),
                tagged_locator('ergnuor.api.persister'),
            ])

        ->alias(RestEntityManagerInterface::class, 'ergnuor.api.entity_manager')

    ;
};
