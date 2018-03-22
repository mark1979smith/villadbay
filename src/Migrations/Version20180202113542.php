<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180202113542 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking CHANGE check_in check_in DATETIME DEFAULT NULL, CHANGE check_out check_out DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE pages ADD data JSON NOT NULL COMMENT \'(DC2Type:json_array)\', DROP heading, DROP text_copy, DROP image_type, DROP publish');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking CHANGE check_in check_in DATETIME DEFAULT NULL, CHANGE check_out check_out DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE pages ADD heading VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, ADD text_copy TEXT DEFAULT NULL COLLATE utf8_unicode_ci, ADD image_type VARCHAR(25) NOT NULL COLLATE utf8_unicode_ci, ADD publish DATETIME NOT NULL, DROP data');
    }
}
