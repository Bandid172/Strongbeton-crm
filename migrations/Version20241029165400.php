<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241029165400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DFCDAEAAA');
        $this->addSql('DROP INDEX UNIQ_6D28840DFCDAEAAA ON payment');
        $this->addSql('ALTER TABLE payment CHANGE order_id_id order_id INT NOT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D28840D8D9F6D38 ON payment (order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D8D9F6D38');
        $this->addSql('DROP INDEX UNIQ_6D28840D8D9F6D38 ON payment');
        $this->addSql('ALTER TABLE payment CHANGE order_id order_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DFCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D28840DFCDAEAAA ON payment (order_id_id)');
    }
}
