<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240817121802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee ADD last_name VARCHAR(255) NOT NULL, ADD middle_name VARCHAR(255) DEFAULT NULL, ADD date_of_birth DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD gender VARCHAR(255) NOT NULL, ADD email VARCHAR(255) DEFAULT NULL, ADD phone_number VARCHAR(255) NOT NULL, ADD address VARCHAR(255) NOT NULL, ADD department VARCHAR(255) NOT NULL, ADD date_of_hire DATETIME NOT NULL, ADD date_of_termination DATETIME DEFAULT NULL, ADD state VARCHAR(255) NOT NULL, ADD notes LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee DROP last_name, DROP middle_name, DROP date_of_birth, DROP gender, DROP email, DROP phone_number, DROP address, DROP department, DROP date_of_hire, DROP date_of_termination, DROP state, DROP notes');
    }
}
