<?php

declare(strict_types=1);

namespace Ergnuor\ApiBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;

trait BundleDetectorTrait
{
    private function hasErgnuorDomainModelBundle(ContainerBuilder $container): bool
    {
        foreach ($container->getParameter('kernel.bundles') as $bundleName => $bundleClass) {
            if ($bundleClass == 'Ergnuor\DomainModelBundle\ErgnuorDomainModelBundle') {
                return true;
            }
        }

        return false;
    }
}
