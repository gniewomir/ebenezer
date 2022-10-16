<?php

declare(strict_types=1);

namespace Tests\Enraged\Ebenezer\Unit\Domain;

use DateTimeImmutable;
use Enraged\Ebenezer\Domain\Asset;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\UuidV4;

/**
 * @internal
 *
 * @covers \Enraged\Ebenezer\Domain\Asset
 */
final class AssetTest extends TestCase
{
    public function test_asset_creation(): void
    {
        $asset = new Asset(
            $id = UuidV4::v4(),
            $createdAt = new DateTimeImmutable()
        );

        self::assertSame($id, $asset->getId());
        self::assertSame($createdAt, $asset->getCreatedAt());
    }
}
