<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240909183423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP expected_delivery_date');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4868C03F15C');
        $this->addSql('DROP INDEX UNIQ_1B80E4868C03F15C ON vehicle');
        $this->addSql('ALTER TABLE vehicle CHANGE employee_id driver_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486C3423909 FOREIGN KEY (driver_id) REFERENCES employee (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1B80E486C3423909 ON vehicle (driver_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD expected_delivery_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486C3423909');
        $this->addSql('DROP INDEX UNIQ_1B80E486C3423909 ON vehicle');
        $this->addSql('ALTER TABLE vehicle CHANGE driver_id employee_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4868C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1B80E4868C03F15C ON vehicle (employee_id)');
    }
}
