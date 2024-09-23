<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240915113444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inflow DROP FOREIGN KEY FK_CBBF3F719395C3F3');
        $this->addSql('ALTER TABLE inflow DROP FOREIGN KEY FK_CBBF3F71C023F51C');
        $this->addSql('DROP INDEX IDX_CBBF3F719395C3F3 ON inflow');
        $this->addSql('DROP INDEX UNIQ_CBBF3F71C023F51C ON inflow');
        $this->addSql('ALTER TABLE inflow DROP customer_id, DROP sales_order_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inflow ADD customer_id INT DEFAULT NULL, ADD sales_order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inflow ADD CONSTRAINT FK_CBBF3F719395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE inflow ADD CONSTRAINT FK_CBBF3F71C023F51C FOREIGN KEY (sales_order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_CBBF3F719395C3F3 ON inflow (customer_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CBBF3F71C023F51C ON inflow (sales_order_id)');
    }
}
