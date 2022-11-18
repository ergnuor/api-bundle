<?php
declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Ergnuor\ApiPlatform\Mapping\ClassMetadataFactoryAdapter;
use Ergnuor\Mapping\ClassMetadataFactory;

return static function (ContainerConfigurator $container) {

    $container->services()
        ->alias('ergnuor.api_platform.serializer', 'serializer')

    ;
};
