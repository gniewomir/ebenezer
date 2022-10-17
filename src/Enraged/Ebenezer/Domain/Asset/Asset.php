<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Domain\Asset;

use DateTimeInterface;
use Decimal\Decimal;
use Money\Currency;
use Symfony\Component\Uid\UuidV4;

class Asset
{
    private ?DateTimeInterface $updated_at = null;
    private ?DateTimeInterface $liquidated_at = null;

    public function __construct(
        private readonly UuidV4 $id,
        private readonly AssetTypeEnum $type,
        private readonly Decimal $units,
        private readonly Currency $currency,
        private readonly DateTimeInterface $created_at,
    ) {
    }

    public function id(): UuidV4
    {
        return $this->id;
    }

    public function createdAt(): DateTimeInterface
    {
        return $this->created_at;
    }

    public function type(): AssetTypeEnum
    {
        return $this->type;
    }

    public function units(): Decimal
    {
        return $this->units;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }
}
