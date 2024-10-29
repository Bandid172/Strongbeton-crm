<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241029174715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inflow ADD currency_id INT NOT NULL');
        $this->addSql('ALTER TABLE inflow ADD CONSTRAINT FK_CBBF3F7138248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_CBBF3F7138248176 ON inflow (currency_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inflow DROP FOREIGN KEY FK_CBBF3F7138248176');
        $this->addSql('DROP INDEX IDX_CBBF3F7138248176 ON inflow');
        $this->addSql('ALTER TABLE inflow DROP currency_id');
    }
}
