<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241029171850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inflow DROP currency_id');
        $this->addSql('ALTER TABLE outflow DROP currency');
        $this->addSql('ALTER TABLE payment DROP currency');
        $this->addSql('ALTER TABLE salary_report DROP currency');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inflow ADD currency_id INT NOT NULL');
        $this->addSql('ALTER TABLE outflow ADD currency VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE payment ADD currency VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE salary_report ADD currency VARCHAR(255) NOT NULL');
    }
}
