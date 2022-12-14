<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221018093055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE eb_asset (id UUID NOT NULL, type TEXT NOT NULL, units NUMERIC(28, 5) NOT NULL, created_at TIMESTAMP(6) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(6) WITHOUT TIME ZONE DEFAULT NULL, liquidated_at TIMESTAMP(6) WITHOUT TIME ZONE DEFAULT NULL, currency_code VARCHAR(3) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN eb_asset.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN eb_asset.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN eb_asset.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN eb_asset.liquidated_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE eb_asset');
    }
}
