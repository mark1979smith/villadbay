<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180605191825 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE carousel_container (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carousel_slides (id INT AUTO_INCREMENT NOT NULL, carousel_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_CA08D1CDB0D24791 (carousel_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carousel_slides ADD CONSTRAINT FK_CA08D1CDB0D24791 FOREIGN KEY (carousel_id_id) REFERENCES carousel_container (id)');
        $this->addSql('ALTER TABLE booking CHANGE check_in check_in DATETIME DEFAULT NULL, CHANGE check_out check_out DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE pages CHANGE publish publish DATETIME NOT NULL');
        $this->addSql('DROP INDEX name ON carousel');
        $this->addSql('ALTER TABLE carousel CHANGE name slug VARCHAR(25) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carousel_slides DROP FOREIGN KEY FK_CA08D1CDB0D24791');
        $this->addSql('DROP TABLE carousel_container');
        $this->addSql('DROP TABLE carousel_slides');
        $this->addSql('ALTER TABLE booking CHANGE check_in check_in DATETIME DEFAULT NULL, CHANGE check_out check_out DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE carousel CHANGE slug name VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX name ON carousel (name)');
        $this->addSql('ALTER TABLE pages CHANGE publish publish DATETIME NOT NULL');
    }
}
