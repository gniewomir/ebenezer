<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Infrastructure\Test\Calendar;

use DateInterval;
use DateTimeImmutable;
use DateTimeInterface;
use Enraged\Ebenezer\Infrastructure\Calendar\CalendarInterface;
use Enraged\Ebenezer\Infrastructure\Exception\LogicInfrastructureException;

final class CalendarStub implements CalendarInterface, \Enraged\Ebenezer\CalendarInterface, TimeOffsetInterface, FixedTimeInterface
{
    private ?DateTimeInterface $fixed = null;
    private ?DateInterval $addOffset = null;
    private ?DateInterval $subOffset = null;

    public function now(): DateTimeInterface
    {
        if ($this->fixed) {
            return $this->fixed;
        }

        if ($this->addOffset) {
            $result = (new DateTimeImmutable())->add($this->addOffset);
            \assert($result instanceof DateTimeInterface);

            return $result;
        }

        if ($this->subOffset) {
            $result = (new DateTimeImmutable())->sub($this->subOffset);
            \assert($result instanceof DateTimeInterface);

            return $result;
        }

        return new DateTimeImmutable();
    }

    public function fixTime(DateTimeInterface $fixed): void
    {
        null === $this->addOffset || throw new LogicInfrastructureException('Cannot offset and fix time simultaneously.');
        null === $this->subOffset || throw new LogicInfrastructureException('Cannot offset and fix time simultaneously.');
        $this->fixed = $fixed;
    }

    public function clearFixedTime(): void
    {
        $this->fixed = null;
    }

    public function addOffset(DateInterval $offset): void
    {
        null === $this->fixed || throw new LogicInfrastructureException('Cannot offset and fix time simultaneously.');
        null === $this->subOffset || throw new LogicInfrastructureException('Cannot add and sub offset simultaneously.');
        $this->addOffset = $offset;
    }

    public function subOffset(DateInterval $offset): void
    {
        null === $this->fixed || throw new LogicInfrastructureException('Cannot offset and fix time simultaneously.');
        null === $this->addOffset || throw new LogicInfrastructureException('Cannot add and sub offset simultaneously.');
        $this->subOffset = $offset;
    }

    public function clearOffset(): void
    {
        $this->addOffset = null;
        $this->subOffset = null;
    }
}
