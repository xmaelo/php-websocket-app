<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211215080133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP INDEX FK_6EEAA67D6BF700BD, ADD UNIQUE INDEX UNIQ_6EEAA67D6BF700BD (status_id)');
        $this->addSql('ALTER TABLE commande DROP INDEX FK_6EEAA67D6FA44F54, ADD UNIQUE INDEX UNIQ_6EEAA67D6FA44F54 (table__id)');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE commande ADD archived TINYINT(1) DEFAULT NULL');
        $this->addSql('DROP INDEX fk_6eeaa67da76ed395 ON commande');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA76ED395 ON commande (user_id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP INDEX UNIQ_6EEAA67D6FA44F54, ADD INDEX FK_6EEAA67D6FA44F54 (table__id)');
        $this->addSql('ALTER TABLE commande DROP INDEX UNIQ_6EEAA67D6BF700BD, ADD INDEX FK_6EEAA67D6BF700BD (status_id)');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE commande DROP archived');
        $this->addSql('DROP INDEX idx_6eeaa67da76ed395 ON commande');
        $this->addSql('CREATE INDEX FK_6EEAA67DA76ED395 ON commande (user_id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}
