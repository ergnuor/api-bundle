<?php
declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Component\Serializer\Serializer;

return static function (ContainerConfigurator $container) {

    $container->services()
        ->set('ergnuor.api.serializer', Serializer::class)
            ->args([[], [service('serializer.encoder.json')]])

        ->set('ergnuor.api.serializer.denormalizer.unwrapping')
            ->parent('ergnuor.domain_model.serializer.common.denormalizer.unwrapping')
            ->tag('ergnuor.api.serializer', ['priority' => 2200])

        ->set('ergnuor.api.serializer.normalizer.collection')
            ->parent('ergnuor.domain_model.serializer.common.normalizer.collection')
            ->tag('ergnuor.api.serializer', ['priority' => 2000])

        ->set('ergnuor.api.serializer.normalizer.domain_entity')
            ->parent('ergnuor.domain_model.serializer.common.normalizer.domain_entity')
            ->tag('ergnuor.api.serializer', ['priority' => 1800])

        ->set('ergnuor.api.serializer.normalizer.doctrine_entity.class_metadata_getter')
            ->parent('ergnuor.domain_model.serializer.common.normalizer.doctrine_entity.class_metadata_getter')

        ->set('ergnuor.api.serializer.normalizer.doctrine_entity')
            ->parent('ergnuor.domain_model.serializer.common.normalizer.doctrine_entity')
            ->tag('ergnuor.api.serializer', ['priority' => 1600])
            /** That arg replacement is not working. Doing it in compiler pass */
//            ->arg(7, service('ergnuor.domain_model.serializer.domain_entity.normalizer.doctrine_entity.class_metadata_getter'))

        ->set('ergnuor.api.serializer.normalizer.backed_enum')
            ->parent('ergnuor.domain_model.serializer.common.normalizer.backed_enum')
            ->tag('ergnuor.api.serializer', ['priority' => 1400])

        ->set('ergnuor.api.serializer.normalizer.json_serializable')
            ->parent('ergnuor.domain_model.serializer.common.normalizer.json_serializable')
            ->tag('ergnuor.api.serializer', ['priority' => 1200])

        ->set('ergnuor.api.serializer.normalizer.datetime')
            ->parent('ergnuor.domain_model.serializer.common.normalizer.datetime')
            ->tag('ergnuor.api.serializer', ['priority' => 1000])

        ->set('ergnuor.api.serializer.normalizer.datetimezone')
            ->parent('ergnuor.domain_model.serializer.common.normalizer.datetimezone')
            ->tag('ergnuor.api.serializer', ['priority' => 800])

        ->set('ergnuor.api.serializer.normalizer.dateinterval')
            ->parent('ergnuor.domain_model.serializer.common.normalizer.dateinterval')
            ->tag('ergnuor.api.serializer', ['priority' => 600])

        ->set('ergnuor.api.serializer.normalizer.data_uri')
            ->parent('ergnuor.domain_model.serializer.common.normalizer.data_uri')
            ->tag('ergnuor.api.serializer', ['priority' => 400])

        ->set('ergnuor.api.serializer.normalizer.array')
            ->parent('ergnuor.domain_model.serializer.common.denormalizer.array')
            ->tag('ergnuor.api.serializer', ['priority' => 200])

        ->set('ergnuor.api.serializer.normalizer.object')
            ->parent('ergnuor.domain_model.serializer.common.normalizer.object')
            ->tag('ergnuor.api.serializer', ['priority' => 0])

    ;
};
