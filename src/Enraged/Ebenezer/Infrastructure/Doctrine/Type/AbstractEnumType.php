<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Infrastructure\Doctrine\Type;

use BackedEnum;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

abstract class AbstractEnumType extends Type
{
    final public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'TEXT';
    }

    final public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if ($value instanceof BackedEnum) {
            return $value->value;
        }

        throw new ConversionException('Provided class should be an backed enum');
    }

    final public function convertToPHPValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if (false === enum_exists($this->getEnumsClass())) {
            throw new ConversionException('Provided class should be an backed enum');
        }
        if (!\is_string($value)) {
            throw new ConversionException('Value is not a string!');
        }

        /** @var BackedEnum $class */
        $class = $this::getEnumsClass();
        $enum = $class::tryFrom($value);
        if (null === $enum) {
            throw new ConversionException('Unrecognized value!');
        }

        return $enum;
    }

    /**
     * @return class-string
     */
    abstract public static function getEnumsClass(): string;
}
