<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211113185515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_order_state (order_id INT NOT NULL, order_state_id INT NOT NULL, INDEX IDX_3BBFD9808D9F6D38 (order_id), INDEX IDX_3BBFD980E420DE70 (order_state_id), PRIMARY KEY(order_id, order_state_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_order_state ADD CONSTRAINT FK_3BBFD9808D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_order_state ADD CONSTRAINT FK_3BBFD980E420DE70 FOREIGN KEY (order_state_id) REFERENCES order_state (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE order_order_state');
    }
}
