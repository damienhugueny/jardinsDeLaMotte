<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200502174537 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE plant_category ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plant_category ADD CONSTRAINT FK_2FEF599312469DE2 FOREIGN KEY (category_id) REFERENCES plant_race (id)');
        $this->addSql('CREATE INDEX IDX_2FEF599312469DE2 ON plant_category (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE plant_category DROP FOREIGN KEY FK_2FEF599312469DE2');
        $this->addSql('DROP INDEX IDX_2FEF599312469DE2 ON plant_category');
        $this->addSql('ALTER TABLE plant_category DROP category_id');
    }
}
