<?php declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Config;
use App\Entity\ConfigGroup;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181109140903 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    const GROUP_NAME = 'Core';

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE config (id INT AUTO_INCREMENT NOT NULL, config_group_id INT NOT NULL, slug VARCHAR(50) NOT NULL, value VARCHAR(255) DEFAULT NULL, is_read_only TINYINT(1) NOT NULL, created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D48A2F7C439C3799 (config_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE config_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE config ADD CONSTRAINT FK_D48A2F7C439C3799 FOREIGN KEY (config_group_id) REFERENCES config_group (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE config DROP FOREIGN KEY FK_D48A2F7C439C3799');
        $this->addSql('DROP TABLE config');
        $this->addSql('DROP TABLE config_group');
    }

    public function postUp(Schema $schema)
    {
        $className = $this->getEntityManager()->getRepository(ConfigGroup::class)->getClassName();
        /** @var ConfigGroup $configGroup */
        $configGroup = new $className;
        $configGroup->setName(self::GROUP_NAME);

        $className = $this->getEntityManager()->getRepository(Config::class)->getClassName();
        /** @var \App\Entity\Config $configEntry */
        $configEntry = new $className;
        $configEntry->setSlug('nav.class');
        $configEntry->setCreated(new \DateTimeImmutable());
        $configEntry->setValue('navbar navbar-expand-sm navbar-dark bg-primary');
        $this->getEntityManager()->persist($configEntry);

        $configGroup->addConfigEntry($configEntry);
        $this->getEntityManager()->persist($configGroup);

        $this->getEntityManager()->flush();
    }

    private function getEntityManager(): EntityManagerInterface
    {
        return $this->container->get('doctrine.orm.entity_manager');
    }
}
