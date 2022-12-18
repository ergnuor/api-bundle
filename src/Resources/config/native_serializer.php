<?php
declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Ergnuor\Api\Mapping\ClassMetadataFactoryAdapter;
use Ergnuor\Mapping\ClassMetadataFactory;

return static function (ContainerConfigurator $container) {

    $container->services()
        ->alias('ergnuor.api.serializer', 'serializer')

    ;
};
