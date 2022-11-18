<?php
declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Ergnuor\ApiPlatform\Registry;
use Ergnuor\ApiPlatform\RegistryInterface;
use Ergnuor\ApiPlatform\Request\RequestInterface;
use Ergnuor\ApiPlatform\Request\SymfonyRequest;

return static function (ContainerConfigurator $container) {

    $container->services()
        ->set('ergnuor.api_platform.registry', Registry::class)
            ->args([
                service('ergnuor.api_platform.entity_manager'),
                service('ergnuor.api_platform.serializer'),
                service('Symfony\Component\Validator\Validator\ValidatorInterface'),
                service('ergnuor.api_platform.request.symfony_request'),
            ])

        ->alias(id: RegistryInterface::class, referencedId: 'ergnuor.api_platform.registry')

        ->set('ergnuor.api_platform.request.symfony_request', SymfonyRequest::class)
        ->args([
            service('Symfony\Component\HttpFoundation\RequestStack'),
        ])

        ->alias(RequestInterface::class, 'ergnuor.api_platform.request.symfony_request')
    ;
};
