<?php

declare(strict_types=1);

namespace Ergnuor\ApiPlatformBundle;

use Ergnuor\ApiPlatformBundle\DependencyInjection\Compiler\MetadataPass;
use Ergnuor\ApiPlatformBundle\DependencyInjection\Compiler\SerializerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ErgnuorApiPlatformBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new SerializerPass());
        $container->addCompilerPass(new MetadataPass());
    }

}