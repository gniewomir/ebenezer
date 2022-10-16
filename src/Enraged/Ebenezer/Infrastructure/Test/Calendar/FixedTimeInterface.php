<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Infrastructure\Test\Calendar;

use DateTimeInterface;

interface FixedTimeInterface
{
    public function fixTime(DateTimeInterface $fixed): void;

    public function clearFixedTime(): void;
}
