<?php

declare(strict_types=1);

namespace Tests\Enraged\Ebenezer\Unit\Domain;

use DateTimeImmutable;
use Decimal\Decimal;
use Enraged\Ebenezer\Domain\Asset\Asset;
use Enraged\Ebenezer\Domain\Asset\AssetTypeEnum;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\UuidV4;

/**
 * @internal
 *
 * @covers \Enraged\Ebenezer\Domain\Asset\Asset
 */
final class AssetTest extends TestCase
{
    public function test_asset_creation(): void
    {
        $asset = new Asset(
            $id = UuidV4::v4(),
            $type = AssetTypeEnum::CASH,
            new Decimal('10'),
            $createdAt = new DateTimeImmutable()
        );

        self::assertSame($id, $asset->id());
        self::assertSame($type, $asset->type());
        self::assertSame($createdAt, $asset->createdAt());
    }
}
