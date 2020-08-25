<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200502180540 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE plant (id INT AUTO_INCREMENT NOT NULL, plant_category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, status INT NOT NULL, price VARCHAR(20) NOT NULL, unite VARCHAR(20) NOT NULL, INDEX IDX_AB030D72C2D8DA42 (plant_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plant_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plant_category (id INT AUTO_INCREMENT NOT NULL, plant_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_2FEF5993BFC546EA (plant_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D72C2D8DA42 FOREIGN KEY (plant_category_id) REFERENCES plant_category (id)');
        $this->addSql('ALTER TABLE plant_category ADD CONSTRAINT FK_2FEF5993BFC546EA FOREIGN KEY (plant_type_id) REFERENCES plant_type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE plant_category DROP FOREIGN KEY FK_2FEF5993BFC546EA');
        $this->addSql('ALTER TABLE plant DROP FOREIGN KEY FK_AB030D72C2D8DA42');
        $this->addSql('DROP TABLE plant');
        $this->addSql('DROP TABLE plant_type');
        $this->addSql('DROP TABLE plant_category');
    }
}
