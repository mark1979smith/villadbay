<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180112212636 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pages (id INT AUTO_INCREMENT NOT NULL, route_name VARCHAR(100) NOT NULL, heading VARCHAR(100) NOT NULL, text_copy TEXT DEFAULT NULL, image_type ENUM(\'full-page\', \'panoramic\'), INDEX route_name (route_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking CHANGE check_in check_in DATETIME DEFAULT NULL, CHANGE check_out check_out DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pages');
        $this->addSql('ALTER TABLE booking CHANGE check_in check_in DATETIME DEFAULT NULL, CHANGE check_out check_out DATETIME DEFAULT NULL');
    }
}
