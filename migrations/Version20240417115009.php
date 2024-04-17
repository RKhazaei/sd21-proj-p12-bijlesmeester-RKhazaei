<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240417115009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchaseline ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE purchaseline ADD CONSTRAINT FK_454341094584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_454341094584665A ON purchaseline (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchaseline DROP FOREIGN KEY FK_454341094584665A');
        $this->addSql('DROP INDEX IDX_454341094584665A ON purchaseline');
        $this->addSql('ALTER TABLE purchaseline DROP product_id');
    }
}
