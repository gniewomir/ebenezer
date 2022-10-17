<?php

declare(strict_types=1);

namespace Tests\Enraged\Ebenezer\Unit\Infrastructure\Doctrine\Type;

use Decimal\Decimal;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Enraged\Ebenezer\Infrastructure\Doctrine\Type\PhpDecimalType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @covers \Enraged\Ebenezer\Infrastructure\Doctrine\Type\PhpDecimalType
 */
final class PhpDecimalTypeTest extends TestCase
{
    public function test_convert_to_database_value_throws_on_value_requiring_rounding(): void
    {
        $this->expectExceptionObject(new ConversionException('Cannot convert to database value without data loss!'));

        $type = (new PhpDecimalType());

        $decimal_value_with_more_decimal_places_than_database_field = new Decimal(
            '0.'.str_repeat('1', PhpDecimalType::SCALE + 1),
            PhpDecimalType::PRECISION
        );

        $type->convertToDatabaseValue(
            $decimal_value_with_more_decimal_places_than_database_field,
            $this->getMockForAbstractClass(AbstractPlatform::class)
        );
    }

    public function test_convert_to_database_value_throws_on_value_exceeding_precision(): void
    {
        $this->expectExceptionObject(new ConversionException('Cannot convert to database value without data loss!'));

        $type = (new PhpDecimalType());

        $decimal_value_with_more_decimal_places_than_database_field = new Decimal('1', PhpDecimalType::PRECISION + 1);
        $type->convertToDatabaseValue(
            $decimal_value_with_more_decimal_places_than_database_field,
            $this->getMockForAbstractClass(AbstractPlatform::class)
        );
    }
}
