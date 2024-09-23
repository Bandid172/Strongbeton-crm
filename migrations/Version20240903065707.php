<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240903065707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer ADD notes LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE organization ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE organization ADD CONSTRAINT FK_C1EE637C9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_C1EE637C9395C3F3 ON organization (customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP notes');
        $this->addSql('ALTER TABLE organization DROP FOREIGN KEY FK_C1EE637C9395C3F3');
        $this->addSql('DROP INDEX IDX_C1EE637C9395C3F3 ON organization');
        $this->addSql('ALTER TABLE organization DROP customer_id');
    }
}
