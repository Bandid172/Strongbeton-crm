<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241013100328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_vehicle (order_id INT NOT NULL, vehicle_id INT NOT NULL, INDEX IDX_EDFA4DCD8D9F6D38 (order_id), INDEX IDX_EDFA4DCD545317D1 (vehicle_id), PRIMARY KEY(order_id, vehicle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_vehicle ADD CONSTRAINT FK_EDFA4DCD8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_vehicle ADD CONSTRAINT FK_EDFA4DCD545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_vehicle DROP FOREIGN KEY FK_EDFA4DCD8D9F6D38');
        $this->addSql('ALTER TABLE order_vehicle DROP FOREIGN KEY FK_EDFA4DCD545317D1');
        $this->addSql('DROP TABLE order_vehicle');
    }
}
