<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Infrastructure\Calendar;

use DateTimeImmutable;
use DateTimeInterface;

class Calendar implements CalendarInterface, \Enraged\Ebenezer\CalendarInterface
{
    public function now(): DateTimeInterface
    {
        return new DateTimeImmutable();
    }
}
