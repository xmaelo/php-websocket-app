<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211113105109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consommable DROP FOREIGN KEY FK_A04C7F4D714819A0');
        $this->addSql('DROP INDEX IDX_A04C7F4D714819A0 ON consommable');
        $this->addSql('ALTER TABLE consommable ADD type_consommable_id INT DEFAULT NULL, DROP type_id_id, CHANGE picture picture VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE consommable ADD CONSTRAINT FK_A04C7F4D9F0D9A15 FOREIGN KEY (type_consommable_id) REFERENCES type_consommable (id)');
        $this->addSql('CREATE INDEX IDX_A04C7F4D9F0D9A15 ON consommable (type_consommable_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consommable DROP FOREIGN KEY FK_A04C7F4D9F0D9A15');
        $this->addSql('DROP INDEX IDX_A04C7F4D9F0D9A15 ON consommable');
        $this->addSql('ALTER TABLE consommable ADD type_id_id INT NOT NULL, DROP type_consommable_id, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE picture picture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE consommable ADD CONSTRAINT FK_A04C7F4D714819A0 FOREIGN KEY (type_id_id) REFERENCES type_consommable (id)');
        $this->addSql('CREATE INDEX IDX_A04C7F4D714819A0 ON consommable (type_id_id)');
    }
}
