<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Application;

use Decimal\Decimal;
use Enraged\Ebenezer\CalendarInterface;
use Enraged\Ebenezer\Domain\Asset\Asset;
use Enraged\Ebenezer\Domain\Asset\AssetInterface;
use Enraged\Ebenezer\Domain\Asset\AssetTypeEnum;
use Money\Currency;
use Symfony\Component\Uid\UuidV4;

final class AssetFacade
{
    public function __construct(
        private readonly CalendarInterface $calendar,
        private readonly AssetInterface $asset
    ) {
    }

    public function createAsset(UuidV4 $id, AssetTypeEnum $type, Decimal $units, Currency $currency): void
    {
        $this->asset->persist(
            new Asset(
                $id,
                $type,
                $units,
                $currency,
                $this->calendar->now()
            )
        );
    }
}
