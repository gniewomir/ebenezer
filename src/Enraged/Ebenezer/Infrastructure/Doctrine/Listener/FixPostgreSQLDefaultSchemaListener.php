<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Infrastructure\Doctrine\Listener;

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\PostgreSQLSchemaManager;
use Doctrine\DBAL\Schema\SchemaException;
use Doctrine\ORM\Tools\Event\GenerateSchemaEventArgs;

/**
 * Workaround.
 *
 * @see https://github.com/doctrine/dbal/issues/1110
 * @see https://gist.github.com/mvmaasakkers/7c28355715850d991fb9feb649e60463
 */
final class FixPostgreSQLDefaultSchemaListener
{
    /**
     * @throws SchemaException
     * @throws Exception
     */
    public function postGenerateSchema(GenerateSchemaEventArgs $args): void
    {
        /** @var PostgreSQLSchemaManager $schemaManager */
        $schemaManager = $args
            ->getEntityManager()
            ->getConnection()
            ->createSchemaManager();

        if (!$schemaManager instanceof PostgreSQLSchemaManager) {
            return;
        }

        $schema = $args->getSchema();

        foreach ($schemaManager->listSchemaNames() as $namespace) {
            if (!$schema->hasNamespace($namespace)) {
                $schema->createNamespace($namespace);
            }
        }
    }
}
