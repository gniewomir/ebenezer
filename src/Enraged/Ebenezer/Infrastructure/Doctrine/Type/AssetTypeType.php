<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Infrastructure\Doctrine\Type;

use Enraged\Ebenezer\Domain\Asset\AssetTypeEnum;

final class AssetTypeType extends AbstractEnumType
{
    public const NAME = 'asset_type';

    public static function getEnumsClass(): string
    {
        return AssetTypeEnum::class;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
