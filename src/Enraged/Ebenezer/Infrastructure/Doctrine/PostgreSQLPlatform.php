<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Infrastructure\Doctrine;

use Doctrine\Deprecations\Deprecation;

/**
 * Ensure time is stored with microseconds.
 */
class PostgreSQLPlatform extends \Doctrine\DBAL\Platforms\PostgreSQLPlatform
{
    /**
     * {@inheritDoc}
     *
     * @deprecated generate dates within the application
     */
    public function getNowExpression(): string
    {
        Deprecation::trigger(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/4753',
            'PostgreSQLPlatform::getNowExpression() is deprecated. Generate dates within the application.',
        );

        return 'LOCALTIMESTAMP(6)';
    }

    /**
     * {@inheritDoc}
     */
    public function getDateTimeTypeDeclarationSQL(array $column): string
    {
        return 'TIMESTAMP(6) WITHOUT TIME ZONE';
    }

    /**
     * {@inheritDoc}
     */
    public function getDateTimeTzTypeDeclarationSQL(array $column): string
    {
        return 'TIMESTAMP(6) WITH TIME ZONE';
    }

    /**
     * Gets the format string, as accepted by the date() function, that describes
     * the format of a stored datetime value of this platform.
     *
     * @return string the format string
     */
    public function getDateTimeFormatString(): string
    {
        return 'Y-m-d H:i:s.u';
    }

    /**
     * {@inheritDoc}
     */
    public function getDateTimeTzFormatString(): string
    {
        return 'Y-m-d H:i:s.uO';
    }

    /**
     * Gets the format string, as accepted by the date() function, that describes
     * the format of a stored time value of this platform.
     *
     * @return string the format string
     */
    public function getTimeFormatString(): string
    {
        return 'H:i:s.u';
    }
}
