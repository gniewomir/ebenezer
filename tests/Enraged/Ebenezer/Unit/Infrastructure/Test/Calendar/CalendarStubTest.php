<?php

declare(strict_types=1);

namespace Tests\Enraged\Ebenezer\Unit\Infrastructure\Test\Calendar;

use DateInterval;
use DateTimeImmutable;
use Enraged\Ebenezer\Infrastructure\Exception\LogicInfrastructureException;
use Enraged\Ebenezer\Infrastructure\Test\Calendar\CalendarStub;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @covers \Enraged\Ebenezer\Infrastructure\Test\Calendar\CalendarStub
 */
final class CalendarStubTest extends TestCase
{
    public function test_now_returns_current_time_when_no_offset_or_fixed_time_is_set(): void
    {
        $calendar = new CalendarStub();
        self::assertSame((new DateTimeImmutable())->format(DATE_ATOM), $calendar->now()->format(DATE_ATOM));
    }

    public function test_now_returns_fixed_time_if_fixed_time_was_set(): void
    {
        $calendar = new CalendarStub();
        $calendar->fixTime($fixed = new DateTimeImmutable());
        self::assertSame($fixed->format('u'), $calendar->now()->format('u'));
    }

    public function test_now_returns_time_with_added_offset_if_set(): void
    {
        $calendar = new CalendarStub();
        $calendar->addOffset($offset = new DateInterval(sprintf('P%dY', $years = 7)));

        self::assertSame(
            (string) ((int) (new DateTimeImmutable())->format('Y') + $years),
            $calendar->now()->format('Y')
        );
    }

    public function test_now_returns_time_with_subtracted_offset_if_set(): void
    {
        $calendar = new CalendarStub();
        $calendar->subOffset($offset = new DateInterval(sprintf('P%dY', $years = 7)));
        self::assertSame(
            (string) ((int) (new DateTimeImmutable())->format('Y') - $years),
            $calendar->now()->format('Y')
        );
    }

    public function test_attempt_to_fix_time_and_add_offset_simultaneously_throws_exception(): void
    {
        $this->expectExceptionObject(new LogicInfrastructureException('Cannot offset and fix time simultaneously.'));
        $calendar = new CalendarStub();
        $calendar->fixTime(new DateTimeImmutable());
        $calendar->addOffset(new DateInterval('P1D'));
    }

    public function test_attempt_to_fix_time_and_sub_offset_simultaneously_throws_exception(): void
    {
        $this->expectExceptionObject(new LogicInfrastructureException('Cannot offset and fix time simultaneously.'));
        $calendar = new CalendarStub();
        $calendar->fixTime(new DateTimeImmutable());
        $calendar->subOffset(new DateInterval('P1D'));
    }

    public function test_attempt_to_sub_and_add_offset_simultaneously_throws_exception(): void
    {
        $this->expectExceptionObject(new LogicInfrastructureException('Cannot add and sub offset simultaneously.'));
        $calendar = new CalendarStub();
        $calendar->addOffset(new DateInterval('P1D'));
        $calendar->subOffset(new DateInterval('P1D'));
    }

    public function test_fixed_time_can_be_cleared(): void
    {
        $calendar = new CalendarStub();
        $calendar->fixTime(new DateTimeImmutable());
        $calendar->clearFixedTime();
        self::assertSame((new DateTimeImmutable())->format(DATE_ATOM), $calendar->now()->format(DATE_ATOM));
    }

    public function test_attempt_to_add_offset_and_fix_time_simultaneously_throws_exception(): void
    {
        $this->expectExceptionObject(new LogicInfrastructureException('Cannot offset and fix time simultaneously.'));
        $calendar = new CalendarStub();
        $calendar->addOffset(new DateInterval('P1D'));
        $calendar->fixTime(new DateTimeImmutable());
    }

    public function test_attempt_to_sub_offset_and_fix_time_simultaneously_throws_exception(): void
    {
        $this->expectExceptionObject(new LogicInfrastructureException('Cannot offset and fix time simultaneously.'));
        $calendar = new CalendarStub();
        $calendar->subOffset(new DateInterval('P1D'));
        $calendar->fixTime(new DateTimeImmutable());
    }

    public function test_added_offset_can_be_cleared(): void
    {
        $calendar = new CalendarStub();
        $calendar->addOffset(new DateInterval('P1D'));
        $calendar->clearOffset();
        self::assertSame((new DateTimeImmutable())->format(DATE_ATOM), $calendar->now()->format(DATE_ATOM));
    }

    public function test_subtracted_offset_can_be_cleared(): void
    {
        $calendar = new CalendarStub();
        $calendar->subOffset(new DateInterval('P1D'));
        $calendar->clearOffset();
        self::assertSame((new DateTimeImmutable())->format(DATE_ATOM), $calendar->now()->format(DATE_ATOM));
    }
}
