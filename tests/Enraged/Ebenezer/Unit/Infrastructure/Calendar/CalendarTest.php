<?php

declare(strict_types=1);

namespace Tests\Enraged\Ebenezer\Unit\Infrastructure\Calendar;

use DateTimeImmutable;
use Enraged\Ebenezer\Infrastructure\Calendar\Calendar;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @covers \Enraged\Ebenezer\Infrastructure\Calendar\Calendar
 */
final class CalendarTest extends TestCase
{
    public function test_now_returns_current_time(): void
    {
        $calendar = new Calendar();
        self::assertSame((new DateTimeImmutable())->format(DATE_ATOM), $calendar->now()->format(DATE_ATOM));
    }
}
