<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Infrastructure\Doctrine\Type;

use Decimal\Decimal;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use DomainException;
use TypeError;

class PhpDecimalType extends Type
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'DECIMAL(20,5)';
    }

    final public function convertToPHPValue(mixed $value, AbstractPlatform $platform): Decimal
    {
        try {
            if (!\is_string($value)) {
                throw new TypeError('Database value have to be an string.');
            }

            return new Decimal($value, 5);
        } catch (TypeError|DomainException $exception) {
            throw ConversionException::conversionFailed($value, $this->getName(), $exception);
        }
    }

    public function getName(): string
    {
        return 'php_decimal';
    }
}
