<?php
declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Component\Serializer\Serializer;

return static function (ContainerConfigurator $container) {

    $container->services()
        ->set('ergnuor.api.serializer', Serializer::class)
            ->args([[], [service('serializer.encoder.json')]])

        ->set('ergnuor.api.serializer.denormalizer.unwrapping')
            ->parent('serializer.denormalizer.unwrapping')
            ->tag('ergnuor.api.serializer.normalizer', ['priority' => 2200])

        ->set('ergnuor.api.serializer.normalizer.collection')
            ->parent('ergnuor.serializer.normalizer.collection')
            ->tag('ergnuor.api.serializer.normalizer', ['priority' => 2000])

        ->set('ergnuor.api.serializer.normalizer.domain_entity')
            ->parent('ergnuor.domain_model.serializer.normalizer.domain_entity')
            ->tag('ergnuor.api.serializer.normalizer', ['priority' => 1800])

        ->set('ergnuor.api.serializer.normalizer.doctrine_entity')
            ->parent('ergnuor.serializer.normalizer.doctrine_entity')
            ->tag('ergnuor.api.serializer.normalizer', ['priority' => 1600])

        ->set('ergnuor.api.serializer.normalizer.backed_enum')
            ->parent('serializer.normalizer.backed_enum')
            ->tag('ergnuor.api.serializer.normalizer', ['priority' => 1400])

        ->set('ergnuor.api.serializer.normalizer.json_serializable')
            ->parent('serializer.normalizer.json_serializable')
            ->tag('ergnuor.api.serializer.normalizer', ['priority' => 1200])

        ->set('ergnuor.api.serializer.normalizer.datetime')
            ->parent('ergnuor.serializer.normalizer.datetime')
            ->tag('ergnuor.api.serializer.normalizer', ['priority' => 1000])

        ->set('ergnuor.api.serializer.normalizer.datetimezone')
            ->parent('serializer.normalizer.datetimezone')
            ->tag('ergnuor.api.serializer.normalizer', ['priority' => 800])

        ->set('ergnuor.api.serializer.normalizer.dateinterval')
            ->parent('serializer.normalizer.dateinterval')
            ->tag('ergnuor.api.serializer.normalizer', ['priority' => 600])

        ->set('ergnuor.api.serializer.normalizer.data_uri')
            ->parent('serializer.normalizer.data_uri')
            ->tag('ergnuor.api.serializer.normalizer', ['priority' => 400])

        ->set('ergnuor.api.serializer.normalizer.array')
            ->parent('serializer.denormalizer.array')
            ->tag('ergnuor.api.serializer.normalizer', ['priority' => 200])

        ->set('ergnuor.api.serializer.normalizer.object')
            ->parent('ergnuor.serializer.normalizer.object')
            ->tag('ergnuor.api.serializer.normalizer', ['priority' => 0])

    ;
};
