<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Infrastructure\ORM;

use Doctrine\ORM\EntityManagerInterface;
use Enraged\Ebenezer\Domain\Asset;
use Enraged\Ebenezer\Domain\AssetInterface;
use Enraged\Ebenezer\Infrastructure\Exception\NotFoundInfrastructureException;
use Symfony\Component\Uid\Uuid;

final class AssetRepository implements AssetInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entity_manager
    ) {
    }

    public function persist(Asset $asset): void
    {
        $this
            ->entity_manager
            ->persist($asset);
        $this
            ->entity_manager
            ->flush();
    }

    public function getById(Uuid $id): Asset
    {
        $entity = $this
            ->entity_manager
            ->getRepository(Asset::class)
            ->find($id);

        if ($entity instanceof Asset) {
            return $entity;
        }

        throw new NotFoundInfrastructureException('Asset not found by ID');
    }
}
