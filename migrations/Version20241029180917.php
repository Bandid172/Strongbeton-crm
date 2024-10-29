<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241029180917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD currency_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939838248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_F529939838248176 ON `order` (currency_id)');
        $this->addSql('ALTER TABLE outflow ADD currency_id INT NOT NULL');
        $this->addSql('ALTER TABLE outflow ADD CONSTRAINT FK_C4AB306338248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_C4AB306338248176 ON outflow (currency_id)');
        $this->addSql('ALTER TABLE payment ADD currency_id INT NOT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_6D28840D38248176 ON payment (currency_id)');
        $this->addSql('ALTER TABLE product ADD currency_id INT NOT NULL, ADD uom_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA103EEB1 FOREIGN KEY (uom_id) REFERENCES uom (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD38248176 ON product (currency_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADA103EEB1 ON product (uom_id)');
        $this->addSql('ALTER TABLE resource ADD currency_id INT NOT NULL, ADD uom_id INT NOT NULL');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F41638248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F416A103EEB1 FOREIGN KEY (uom_id) REFERENCES uom (id)');
        $this->addSql('CREATE INDEX IDX_BC91F41638248176 ON resource (currency_id)');
        $this->addSql('CREATE INDEX IDX_BC91F416A103EEB1 ON resource (uom_id)');
        $this->addSql('ALTER TABLE salary_report ADD currency_id INT NOT NULL');
        $this->addSql('ALTER TABLE salary_report ADD CONSTRAINT FK_126C338F38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_126C338F38248176 ON salary_report (currency_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939838248176');
        $this->addSql('DROP INDEX IDX_F529939838248176 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP currency_id');
        $this->addSql('ALTER TABLE outflow DROP FOREIGN KEY FK_C4AB306338248176');
        $this->addSql('DROP INDEX IDX_C4AB306338248176 ON outflow');
        $this->addSql('ALTER TABLE outflow DROP currency_id');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D38248176');
        $this->addSql('DROP INDEX IDX_6D28840D38248176 ON payment');
        $this->addSql('ALTER TABLE payment DROP currency_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD38248176');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA103EEB1');
        $this->addSql('DROP INDEX IDX_D34A04AD38248176 ON product');
        $this->addSql('DROP INDEX IDX_D34A04ADA103EEB1 ON product');
        $this->addSql('ALTER TABLE product DROP currency_id, DROP uom_id');
        $this->addSql('ALTER TABLE resource DROP FOREIGN KEY FK_BC91F41638248176');
        $this->addSql('ALTER TABLE resource DROP FOREIGN KEY FK_BC91F416A103EEB1');
        $this->addSql('DROP INDEX IDX_BC91F41638248176 ON resource');
        $this->addSql('DROP INDEX IDX_BC91F416A103EEB1 ON resource');
        $this->addSql('ALTER TABLE resource DROP currency_id, DROP uom_id');
        $this->addSql('ALTER TABLE salary_report DROP FOREIGN KEY FK_126C338F38248176');
        $this->addSql('DROP INDEX IDX_126C338F38248176 ON salary_report');
        $this->addSql('ALTER TABLE salary_report DROP currency_id');
    }
}
