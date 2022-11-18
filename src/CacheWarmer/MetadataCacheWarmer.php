<?php

declare(strict_types=1);

namespace Ergnuor\ApiPlatformBundle\CacheWarmer;

use Ergnuor\ApiPlatform\EntityManager\RestEntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\CacheWarmer\AbstractPhpFileCacheWarmer;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

use function is_file;

class MetadataCacheWarmer extends AbstractPhpFileCacheWarmer
{
    /** @var string */
    private $phpArrayFile;
    private RestEntityManagerInterface $restEntityManager;

    public function __construct(
        RestEntityManagerInterface $restEntityManager,
        string $phpArrayFile
    ) {
        $this->restEntityManager = $restEntityManager;
        $this->phpArrayFile = $phpArrayFile;

        parent::__construct($phpArrayFile);
    }

    public function isOptional(): bool
    {
        return false;
    }

    /** @param string $cacheDir */
    protected function doWarmUp($cacheDir, ArrayAdapter $arrayAdapter): bool
    {
        if (is_file($this->phpArrayFile)) {
            return false;
        }

        $metadataFactory = $this->restEntityManager->getClassMetadataFactory();
        if (count($metadataFactory->getLoadedMetadata()) > 0) {
            $class = __CLASS__;
            throw new \LogicException("{$class} must load metadata first, check priority of your warmers.");
        }

        $metadataFactory->setCache($arrayAdapter);
        $metadataFactory->getAllMetadata();

        return true;
    }
}
