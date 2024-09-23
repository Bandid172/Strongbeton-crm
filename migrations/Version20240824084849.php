<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240824084849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE salary_report (id INT AUTO_INCREMENT NOT NULL, base_salary DOUBLE PRECISION NOT NULL, pay_period VARCHAR(255) NOT NULL, pay_date DATETIME NOT NULL, currency VARCHAR(255) NOT NULL, gross_salary DOUBLE PRECISION NOT NULL, net_salary DOUBLE PRECISION NOT NULL, bonuses INT DEFAULT NULL, deductions INT DEFAULT NULL, tax_information VARCHAR(255) NOT NULL, tax_percentage DOUBLE PRECISION NOT NULL, tax_amount DOUBLE PRECISION NOT NULL, salary_type VARCHAR(255) NOT NULL, payment_method VARCHAR(255) NOT NULL, payroll_status VARCHAR(255) NOT NULL, notes LONGTEXT DEFAULT NULL, paid_salary_amount DOUBLE PRECISION NOT NULL, remaining_salary_amount DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE salary_report');
    }
}
