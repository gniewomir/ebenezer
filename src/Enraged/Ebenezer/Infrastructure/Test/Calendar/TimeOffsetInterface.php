<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Infrastructure\Test\Calendar;

use DateInterval;

interface TimeOffsetInterface
{
    public function addOffset(DateInterval $offset): void;

    public function subOffset(DateInterval $offset): void;

    public function clearOffset(): void;
}
