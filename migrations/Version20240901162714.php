<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240901162714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salary_report ADD employee_id INT NOT NULL');
        $this->addSql('ALTER TABLE salary_report ADD CONSTRAINT FK_126C338F8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('CREATE INDEX IDX_126C338F8C03F15C ON salary_report (employee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salary_report DROP FOREIGN KEY FK_126C338F8C03F15C');
        $this->addSql('DROP INDEX IDX_126C338F8C03F15C ON salary_report');
        $this->addSql('ALTER TABLE salary_report DROP employee_id');
    }
}
