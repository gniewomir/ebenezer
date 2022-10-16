<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Infrastructure\Test\ORM;

use Enraged\Ebenezer\Domain\Asset;
use Enraged\Ebenezer\Domain\AssetInterface;
use Enraged\Ebenezer\Infrastructure\Exception\NotFoundInfrastructureException;
use Symfony\Component\Uid\UuidV4;

final class AssetRepositoryInMemory implements AssetInterface
{
    /**
     * @var Asset[]
     */
    private array $assets = [];

    public function persist(Asset $asset): void
    {
        $this->assets[(string) $asset->getId()] = $asset;
    }

    public function getById(UuidV4 $id): Asset
    {
        if (isset($this->assets[(string) $id]) && ($this->assets[(string) $id] instanceof Asset)) {
            return $this->assets[(string) $id];
        }

        throw new NotFoundInfrastructureException('Asset not found by ID');
    }
}
