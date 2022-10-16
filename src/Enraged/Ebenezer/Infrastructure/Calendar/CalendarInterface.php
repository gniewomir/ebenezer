<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Infrastructure\Calendar;

use DateTimeInterface;

interface CalendarInterface
{
    public function now(): DateTimeInterface;
}
