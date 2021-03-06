<?php declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Config;
use App\Entity\ConfigGroup;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181109140903 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    const GROUP_NAME = 'Core';

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE config (id INT AUTO_INCREMENT NOT NULL, config_group_id INT NOT NULL, slug VARCHAR(50) NOT NULL, opts LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', value VARCHAR(255) DEFAULT NULL, is_read_only TINYINT(1) NOT NULL, created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D48A2F7C439C3799 (config_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE config_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE config ADD CONSTRAINT FK_D48A2F7C439C3799 FOREIGN KEY (config_group_id) REFERENCES config_group (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

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

        /**
         * Nav Colour
         */
        /** @var \App\Entity\Config $configEntry */
        $configEntry = new $className;
        $configEntry->setSlug('nav.colour');
        $configEntry->setCreated(new \DateTimeImmutable());
        $opts = [
            'navbar-dark bg-primary:Blue',
            'navbar-dark bg-secondary:Dark Grey',
            'navbar-dark bg-success:Green',
            'navbar-dark bg-danger:Red',
            'navbar-light bg-warning:Yellow',
            'navbar-light bg-info:Light Blue',
            'navbar-light bg-light:Light Grey',
            'navbar-dark bg-dark:Black',
            'navbar-light bg-white:White',
        ];
        $configEntry->setOpts($opts);
        $configEntry->setValue(current($opts));
        $this->getEntityManager()->persist($configEntry);
        $configGroup->addConfigEntry($configEntry);

        /**
         * Nav Expand
         */
        $configEntry = new $className;
        $configEntry->setSlug('nav.expand');
        $configEntry->setCreated(new \DateTimeImmutable());
        $opts = [
            'navbar-expand-sm: Show menu items only on device width 576px and above',
            '*: Do not show menu items on all devices',
            'navbar-expand-md:Show menu items on device width 768px and above',
            'navbar-expand-lg:Show menu items on device width 992px and above',
            'navbar-expand-xl:Show menu items only on device width 1200px and above',
        ];
        $configEntry->setOpts($opts);
        $configEntry->setValue(current($opts));
        $this->getEntityManager()->persist($configEntry);
        $configGroup->addConfigEntry($configEntry);


        /**
         * Save Config Group
         */
        $this->getEntityManager()->persist($configGroup);

        $this->getEntityManager()->flush();
    }

    private function getEntityManager(): EntityManagerInterface
    {
        return $this->container->get('doctrine.orm.entity_manager');
    }
}
