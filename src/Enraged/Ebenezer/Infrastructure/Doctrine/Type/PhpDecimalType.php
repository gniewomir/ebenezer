<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Infrastructure\Doctrine\Type;

use Decimal\Decimal;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use DomainException;
use TypeError;

use function is_string;

class PhpDecimalType extends Type
{
    public const PRECISION = Decimal::DEFAULT_PRECISION;
    public const SCALE = 5;

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getDecimalTypeDeclarationSQL(
            [
                'precision' => self::PRECISION,
                'scale' => self::SCALE,
            ]
        );
    }

    /**
     * @param mixed $value
     *
     * @throws ConversionException
     */
    final public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if (!$value instanceof Decimal) {
            throw new ConversionException('Provided value should be decimal!');
        }

        if ($value->precision() > self::PRECISION) {
            throw new ConversionException('Cannot convert to database value without data loss!');
        }

        if (!(new Decimal($value->toFixed(self::SCALE)))->equals($value)) {
            throw new ConversionException('Cannot convert to database value without data loss!');
        }

        return $value->toFixed(self::SCALE);
    }

    /**
     * @throws ConversionException
     */
    final public function convertToPHPValue(mixed $value, AbstractPlatform $platform): Decimal
    {
        try {
            if (!is_string($value)) {
                throw new TypeError('Database value have to be an string.');
            }

            return new Decimal($value, self::PRECISION);
        } catch (TypeError|DomainException $exception) {
            throw ConversionException::conversionFailed($value, $this->getName(), $exception);
        }
    }

    public function getName(): string
    {
        return 'php_decimal';
    }
}
