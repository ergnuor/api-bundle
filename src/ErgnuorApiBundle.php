<?php

declare(strict_types=1);

namespace Ergnuor\ApiBundle;

use Ergnuor\ApiBundle\DependencyInjection\Compiler\MetadataPass;
use Ergnuor\ApiBundle\DependencyInjection\Compiler\SerializerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ErgnuorApiBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new SerializerPass());
        $container->addCompilerPass(new MetadataPass());
    }

}