<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211128113833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP INDEX IDX_6EEAA67D6BF700BD, ADD UNIQUE INDEX UNIQ_6EEAA67D6BF700BD (status_id)');
        $this->addSql('ALTER TABLE commande DROP INDEX IDX_6EEAA67D6FA44F54, ADD UNIQUE INDEX UNIQ_6EEAA67D6FA44F54 (table__id)');
        $this->addSql('ALTER TABLE commande DROP taskname');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP INDEX UNIQ_6EEAA67D6FA44F54, ADD INDEX IDX_6EEAA67D6FA44F54 (table__id)');
        $this->addSql('ALTER TABLE commande DROP INDEX UNIQ_6EEAA67D6BF700BD, ADD INDEX IDX_6EEAA67D6BF700BD (status_id)');
        $this->addSql('ALTER TABLE commande ADD taskname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
