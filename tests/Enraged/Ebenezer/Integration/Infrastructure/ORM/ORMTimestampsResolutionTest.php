<?php

declare(strict_types=1);

namespace Tests\Enraged\Ebenezer\Integration\Infrastructure\ORM;

use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Enraged\Ebenezer\Domain\Asset\Asset;
use Enraged\Ebenezer\Domain\Asset\AssetInterface;
use Enraged\Ebenezer\Domain\Asset\AssetTypeEnum;
use Symfony\Component\Uid\UuidV4;
use Tests\Enraged\Ebenezer\Integration\IntegrationTestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class ORMTimestampsResolutionTest extends IntegrationTestCase
{
    public function test_timestamps_are_stored_with_microseconds(): void
    {
        $repository = self::getContainer()->get(AssetInterface::class);
        \assert($repository instanceof AssetInterface);

        $repository->persist(
            new Asset(
                $id = UuidV4::v4(),
                AssetTypeEnum::CASH,
                $createdAt = new DateTimeImmutable()
            )
        );

        $entityManager = self::getContainer()->get(EntityManagerInterface::class);
        \assert($entityManager instanceof EntityManagerInterface);

        // ensure we are checking entity fetched & mapped from database, not in memory object managed by doctrine
        $entityManager->detach($repository->getById($id));

        self::assertInstanceOf(Asset::class, $entity = $repository->getById($id));
        self::assertSame($createdAt->format('u'), $entity->createdAt()->format('u'));
    }
}
