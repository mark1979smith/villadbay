<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180601130257 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking CHANGE check_in check_in DATETIME DEFAULT NULL, CHANGE check_out check_out DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE pages CHANGE publish publish DATETIME NOT NULL');
        $this->addSql('ALTER TABLE carousel RENAME INDEX uniq_1dd747005e237e06 TO name');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking CHANGE check_in check_in DATETIME DEFAULT NULL, CHANGE check_out check_out DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE carousel RENAME INDEX name TO UNIQ_1DD747005E237E06');
        $this->addSql('ALTER TABLE pages CHANGE publish publish DATETIME NOT NULL');
    }
}
