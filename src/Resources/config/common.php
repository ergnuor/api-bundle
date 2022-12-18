<?php
declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Ergnuor\Api\Registry;
use Ergnuor\Api\RegistryInterface;
use Ergnuor\Api\Request\RequestInterface;
use Ergnuor\Api\Request\SymfonyRequest;

return static function (ContainerConfigurator $container) {

    $container->services()
        ->set('ergnuor.api.registry', Registry::class)
            ->args([
                service('ergnuor.api.entity_manager'),
                service('ergnuor.api.serializer'),
                service('Symfony\Component\Validator\Validator\ValidatorInterface'),
                service('ergnuor.api.request.symfony_request'),
            ])

        ->alias(id: RegistryInterface::class, referencedId: 'ergnuor.api.registry')

        ->set('ergnuor.api.request.symfony_request', SymfonyRequest::class)
        ->args([
            service('Symfony\Component\HttpFoundation\RequestStack'),
        ])

        ->alias(RequestInterface::class, 'ergnuor.api.request.symfony_request')
    ;
};
