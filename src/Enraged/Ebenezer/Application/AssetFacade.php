<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Application;

use Enraged\Ebenezer\CalendarInterface;
use Enraged\Ebenezer\Domain\Asset;
use Enraged\Ebenezer\Domain\AssetInterface;
use Symfony\Component\Uid\UuidV4;

final class AssetFacade
{
    public function __construct(
        private readonly CalendarInterface $calendar,
        private readonly AssetInterface $asset
    ) {
    }

    public function createAsset(UuidV4 $id): void
    {
        $this->asset->persist(
            new Asset(
                $id,
                $this->calendar->now()
            )
        );
    }
}
