<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240909172309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vehicle_order (vehicle_id INT NOT NULL, order_id INT NOT NULL, INDEX IDX_97861374545317D1 (vehicle_id), INDEX IDX_978613748D9F6D38 (order_id), PRIMARY KEY(vehicle_id, order_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicle_order ADD CONSTRAINT FK_97861374545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicle_order ADD CONSTRAINT FK_978613748D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicle ADD employee_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4868C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1B80E4868C03F15C ON vehicle (employee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle_order DROP FOREIGN KEY FK_97861374545317D1');
        $this->addSql('ALTER TABLE vehicle_order DROP FOREIGN KEY FK_978613748D9F6D38');
        $this->addSql('DROP TABLE vehicle_order');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4868C03F15C');
        $this->addSql('DROP INDEX UNIQ_1B80E4868C03F15C ON vehicle');
        $this->addSql('ALTER TABLE vehicle DROP employee_id');
    }
}
