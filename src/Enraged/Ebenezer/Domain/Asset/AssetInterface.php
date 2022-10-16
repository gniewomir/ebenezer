<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Domain\Asset;

use Symfony\Component\Uid\UuidV4;

interface AssetInterface
{
    public function persist(Asset $asset): void;

    public function getById(UuidV4 $id): Asset;
}
