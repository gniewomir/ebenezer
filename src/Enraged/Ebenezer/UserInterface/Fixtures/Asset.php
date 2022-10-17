<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\UserInterface\Fixtures;

use Decimal\Decimal;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Enraged\Ebenezer\Application\AssetFacade;
use Enraged\Ebenezer\Domain\Asset\AssetTypeEnum;
use Money\Currency;
use Symfony\Component\Uid\UuidV4;

class Asset implements ORMFixtureInterface
{
    public function __construct(
        private readonly AssetFacade $asset_facade
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $this->asset_facade->createAsset(
            new UuidV4(),
            AssetTypeEnum::CASH,
            new Decimal('10'),
            new Currency('USD')
        );
    }
}
