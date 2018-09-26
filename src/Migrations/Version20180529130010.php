<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180529130010 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE carousel (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(25) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carousel_entries (id INT AUTO_INCREMENT NOT NULL, carousel_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_4F5766EBC1CE5B98 (carousel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carousel_entries ADD CONSTRAINT FK_4F5766EBC1CE5B98 FOREIGN KEY (carousel_id) REFERENCES carousel (id)');
        $this->addSql('ALTER TABLE booking CHANGE check_in check_in DATETIME DEFAULT NULL, CHANGE check_out check_out DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE pages CHANGE publish publish DATETIME NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carousel_entries DROP FOREIGN KEY FK_4F5766EBC1CE5B98');
        $this->addSql('DROP TABLE carousel');
        $this->addSql('DROP TABLE carousel_entries');
        $this->addSql('ALTER TABLE booking CHANGE check_in check_in DATETIME DEFAULT NULL, CHANGE check_out check_out DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE pages CHANGE publish publish DATETIME NOT NULL');
    }
}
