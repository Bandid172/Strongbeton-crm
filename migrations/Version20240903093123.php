<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240903093123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, order_item_id INT NOT NULL, sales_representative_id INT NOT NULL, order_number VARCHAR(255) NOT NULL, order_date DATETIME NOT NULL, delivery_date DATETIME DEFAULT NULL, status VARCHAR(255) NOT NULL, payment_status VARCHAR(255) NOT NULL, shipping_address VARCHAR(255) NOT NULL, total_quantity INT NOT NULL, sub_total DOUBLE PRECISION NOT NULL, discount DOUBLE PRECISION DEFAULT NULL, shipping_cost DOUBLE PRECISION DEFAULT NULL, is_shipping_required TINYINT(1) NOT NULL, total_amount DOUBLE PRECISION NOT NULL, payment_method VARCHAR(255) NOT NULL, paid_amount DOUBLE PRECISION NOT NULL, balance_due DOUBLE PRECISION NOT NULL, expected_delivery_date DATETIME DEFAULT NULL, delivery_status VARCHAR(255) NOT NULL, shipped_date DATETIME DEFAULT NULL, notes LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, INDEX IDX_F52993989395C3F3 (customer_id), INDEX IDX_F5299398E415FB15 (order_item_id), INDEX IDX_F52993988B54B08B (sales_representative_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398E415FB15 FOREIGN KEY (order_item_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993988B54B08B FOREIGN KEY (sales_representative_id) REFERENCES employee (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989395C3F3');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398E415FB15');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993988B54B08B');
        $this->addSql('DROP TABLE `order`');
    }
}
