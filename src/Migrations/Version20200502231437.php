<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200502231437 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_category ADD origin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735656A273CC FOREIGN KEY (origin_id) REFERENCES origin (id)');
        $this->addSql('CREATE INDEX IDX_CDFC735656A273CC ON product_category (origin_id)');
        $this->addSql('ALTER TABLE origin DROP FOREIGN KEY FK_DEF1561EBE6903FD');
        $this->addSql('DROP INDEX IDX_DEF1561EBE6903FD ON origin');
        $this->addSql('ALTER TABLE origin DROP product_category_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE origin ADD product_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE origin ADD CONSTRAINT FK_DEF1561EBE6903FD FOREIGN KEY (product_category_id) REFERENCES product_category (id)');
        $this->addSql('CREATE INDEX IDX_DEF1561EBE6903FD ON origin (product_category_id)');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735656A273CC');
        $this->addSql('DROP INDEX IDX_CDFC735656A273CC ON product_category');
        $this->addSql('ALTER TABLE product_category DROP origin_id');
    }
}
