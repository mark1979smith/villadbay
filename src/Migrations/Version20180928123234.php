<?php declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\CarouselContainer;
use App\Entity\CarouselSlides;
use App\Entity\Page;
use App\Component\Page as PageComponent;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180928123234 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE carousel_container (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, contact_name VARCHAR(100) NOT NULL, contact_address VARCHAR(255) NOT NULL, contact_number VARCHAR(30) NOT NULL, alternative_contact_number VARCHAR(30) DEFAULT NULL, fax_number VARCHAR(30) DEFAULT NULL, email_address VARCHAR(255) NOT NULL, check_in DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', check_out DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', time_of_arrival TIME NOT NULL, adults SMALLINT NOT NULL, children SMALLINT NOT NULL, total_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carousel_slides (id INT AUTO_INCREMENT NOT NULL, carousel_id_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_CA08D1CDB0D24791 (carousel_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carousel_slides ADD CONSTRAINT FK_CA08D1CDB0D24791 FOREIGN KEY (carousel_id_id) REFERENCES carousel_container (id)');
        $this->addSql('ALTER TABLE pages CHANGE publish publish DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function postUp(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $carouselContainerClassName = $this->getEntityManager()->getRepository(CarouselContainer::class)->getClassName();
        /** @var CarouselContainer $carouselContainer */
        $carouselContainer = new $carouselContainerClassName;
        $carouselContainer->setName('Our Villa');

        $carouselSlidesClassName = $this->getEntityManager()->getRepository(CarouselSlides::class)->getClassName();
        /** @var CarouselSlides $carouselSlides */
        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/8144771dbbc5ba13a64d6b76b5bf0b47.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/e26c6d1ba38a47c6c2ea185a9f9a01c4.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/8ae7c70fc01343a733423745b666f2bc.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/73d5d5ce3baca995f18ee7c0bece1093.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/51bf751a6468018bdd6084ebac60d396.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/68b396a4064a7fc581575eeee2a5120b.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/48feb56f98b7cfbb95a1542240b97abb.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/9cedf82a08b3f1c4ca9eff52760d87cd.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/bb93edfe1fe404be10b40eb9158fcf7d.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/d86f2cea976a9edac387bc798aff5197.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/27fa5e5325847db75a57331eb2c259c2.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/a726f76d96b188cc2e047ec5e0571c39.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/a7bd669f84016a4a055d71f3500d8f4c.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/8f087120c8e12e416c1a5ceed2693f8f.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/5dd1b7fa071d9cfe5254cd6c06e67ac8.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setImage('images/carousel/72db37029f7f34d8442391129e4c17a9.jpeg');
        $this->getEntityManager()->persist($carouselSlides);
        $carouselContainer->addCarouselSlide($carouselSlides);
        $this->getEntityManager()->persist($carouselContainer);

        $className = $this->getEntityManager()->getRepository(Page::class)->getClassName();
        /**
         * Search Page
         */
        /** @var Page $page */
        $page = new $className;
        $page->setRouteName('search')
            ->setPublish(new \DateTimeImmutable())
            ->setPreview(false)
            ->setData([
                'page_type' => (new PageComponent\PageType())->setPageType('content'),
                'form' => [
                    4 => 'search-form'
                ],
                'list_group' => [],
                'page_route' => (new PageComponent\PageRoute())->setPageRoute('search'),
                'page_stage' => 'options',
                'text_heading' => [2 => (new PageComponent\TextHeading())
                    ->setType((new PageComponent\TextHeading\Type())->setValue('h1'))
                    ->setSizeClass((new PageComponent\TextHeading\SizeClass())->setValue('display-3'))
                    ->setColourClass((new PageComponent\TextHeading\ColourClass())->setValue('text-dark'))
                    ->setAlignClass((new PageComponent\TextHeading\AlignClass())->setValue('text-left'))
                    ->setTextValue((new PageComponent\TextHeading\TextValue())->setValue('Search Availability'))],
                'text_leading'=> [3 => (new PageComponent\TextLead())
                    ->setTextValue("With it's spacious feel and luxurious Queen bed, our Executive room is perfect if you\r\n                    like to stretch out and relax. There is a comfortable seating area, along with luxurious bedding\r\n                    that will guarantee you a great night’s sleep.")
                ],
                'display_order' => [
                    "0" => "0",
                    "form--4" => "4",
                    "text_leading--3" => "3",
                    "panoramic_image--1" => "1",
                    "text_heading_type--2" => "2",
                    "text_heading_size_class--2" => "2",
                    "text_heading_text_value--2" => "2",
                    "text_heading_align_class--2" => "2",
                    "text_heading_colour_class--2" =>  "2"
                ],
                'image_carousel' => [],
                'paragraph_text' => [],
                'panoramic_image' => [
                    1 => (new PageComponent\PanoramicImage())
                        ->setPanoramicImage('images/pano/a0dd58cab182c901b644e34e75be7ce5.jpeg')
                ],
                'background_image' => []
            ]);
        $this->getEntityManager()->persist($page);

        $page = new $className;
        $page->setRouteName('contact')
            ->setPublish(new \DateTimeImmutable())
            ->setPreview(false)
            ->setData([
                'form' => [
                    4 => 'contact-form'
                ],
                'page_type' => (new PageComponent\PageType())->setPageType('content'),
                'list_group' => [],
                'page_route' => (new PageComponent\PageRoute())->setPageRoute('contact'),
                'page_stage' => 'options',
                'text_heading' => [
                    2 => (new PageComponent\TextHeading())
                    ->setType((new PageComponent\TextHeading\Type())->setValue('h1'))
                    ->setSizeClass((new PageComponent\TextHeading\SizeClass())->setValue('display-3'))
                    ->setColourClass((new PageComponent\TextHeading\ColourClass())->setValue('text-dark'))
                    ->setAlignClass((new PageComponent\TextHeading\AlignClass())->setValue('text-left'))
                    ->setTextValue((new PageComponent\TextHeading\TextValue())->setValue('Contact the Villa'))
                ],
                'text_leading' => [
                    3 => (new PageComponent\TextLead())->setTextValue('Should you have any questions please don\'t hesitate to contact us.')
                ],
                'display_order' => [
                    "0" => "0",
                    "form--4" => "4",
                    "text_leading--3" =>  "3",
                    "panoramic_image--1" =>  "1",
                    "text_heading_type--2" =>  "2",
                    "text_heading_size_class--2" =>  "2",
                    "text_heading_text_value--2" => "2",
                    "text_heading_align_class--2" => "2",
                    "text_heading_colour_class--2" => "2"
                ],
                'image_carousel' => [],
                'paragraph_text' => [],
                'panoramic_image' => [
                    1 => (new PageComponent\PanoramicImage())->setPanoramicImage('images/pano/af7bb474323ab24ad8f99d890255f976.jpeg')
                ],
                'background_image' => [],
            ]);
        $this->getEntityManager()->persist($page);

        $page = new $className;
        $page->setRouteName('about')
            ->setPublish(new \DateTimeImmutable())
            ->setPreview(false)
            ->setData([
                'form' => [],
                'page_type' => (new PageComponent\PageType())->setPageType('content'),
                'list_group' => [
                    8 => (new PageComponent\ListGroup())->setListItems([
                        'Free resident car parking',
                        'Fully Self contained',
                        'Free WI-FI access',
                        '24 hour check-in available',
                        'Business services',
                        'Flat screen TV',
                        'Laundry facilities',
                        'DVD player',
                        'Tea & coffee making facilities',
                        'Iron & ironing board'
                    ])
                ],
                'page_route' => (new PageComponent\PageRoute())->setPageRoute('about'),
                'page_stage' => 'options',
                'text_heading' => [
                    1 => (new PageComponent\TextHeading())
                        ->setType((new PageComponent\TextHeading\Type())->setValue('h1'))
                        ->setSizeClass((new PageComponent\TextHeading\SizeClass())->setValue('display-3'))
                        ->setColourClass((new PageComponent\TextHeading\ColourClass())->setValue('text-dark'))
                        ->setAlignClass((new PageComponent\TextHeading\AlignClass())->setValue('text-left'))
                        ->setTextValue((new PageComponent\TextHeading\TextValue())->setValue('About the Villa at The Bay'))
                ],
                'text_leading' => [
                    2 => (new PageComponent\TextLead())->setTextValue('Situated in Deception Bay in the Queensland region, The Villa at The Bay is a villa featuring a patio and garden views.')
                ],
                'display_order' => [
                    "0" => "0",
                    "list_group--8" => "7",
                    "text_leading--2" => "3",
                    "image_carousel--9" => "8",
                    "paragraph_text--5" => "4",
                    "paragraph_text--6" => "5",
                    "paragraph_text--7" => "6",
                    "panoramic_image--4" => "1",
                    "text_heading_type--1" => "2",
                    "text_heading_size_class--1" => "2",
                    "text_heading_text_value--1" => "2",
                    "text_heading_align_class--1" => "2",
                    "text_heading_colour_class--1" => "2"
                ],
                'image_carousel' => [
                    9 => $carouselContainer
                ],
                'paragraph_text' => [
                    5 => (new PageComponent\ParagraphText())->setTextValue('The accommodation is 33 km from Brisbane, and guests benefit from complimentary WiFi and private parking available on site.'),
                    6 => (new PageComponent\ParagraphText())->setTextValue('The villa is equipped with 1 separate bedroom and includes a kitchen with an oven and a dining area. The villa also offers a flat-screen TV, a seating area, and a bathroom with a shower.'),
                    7 => (new PageComponent\ParagraphText())->setTextValue('Margate is 13 km from The Villa at The Bay, while Caloundra is 43 km from the property. Brisbane Airport is 26 km away.')
                ],
                'panoramic_image' => [
                    4 => (new PageComponent\PanoramicImage())->setPanoramicImage('images/pano/af7bb474323ab24ad8f99d890255f976.jpeg')
                ],
                'background_image' => [],
            ]);
        $this->getEntityManager()->persist($page);

        $page = new $className;
        $page->setRouteName('home')
            ->setPublish(new \DateTimeImmutable())
            ->setPreview(false)
            ->setData([
                'form' => [
                    2 => 'search-form'
                ],
                'page_type' => (new PageComponent\PageType())->setPageType('landing'),
                'list_group' => [],
                'page_stage' => 'options',
                'page_route' => (new PageComponent\PageRoute())->setPageRoute('home'),
                'text_heading' => [
                    3 => (new PageComponent\TextHeading())
                        ->setType((new PageComponent\TextHeading\Type())->setValue('h1'))
                        ->setSizeClass((new PageComponent\TextHeading\SizeClass())->setValue('display-3'))
                        ->setColourClass((new PageComponent\TextHeading\ColourClass())->setValue('text-dark'))
                        ->setAlignClass((new PageComponent\TextHeading\AlignClass())->setValue('text-center'))
                        ->setTextValue((new PageComponent\TextHeading\TextValue())->setValue('The Villa at The Bay')),
                    4 => (new PageComponent\TextHeading())
                        ->setType((new PageComponent\TextHeading\Type())->setValue('h3'))
                        ->setSizeClass((new PageComponent\TextHeading\SizeClass())->setValue('display-5'))
                        ->setColourClass((new PageComponent\TextHeading\ColourClass())->setValue('text-white'))
                        ->setAlignClass((new PageComponent\TextHeading\AlignClass())->setValue('text-center'))
                        ->setTextValue((new PageComponent\TextHeading\TextValue())->setValue('LIFE AS IT SHOULD BE')),
                ],
                'text_leading' => [],
                'display_order' => [
                    "0" => "0",
                    "form--2" => "4",
                    "background_image--1" => "1",
                    "text_heading_type--3" => "2",
                    "text_heading_type--4" => "3",
                    "text_heading_size_class--3" => "2",
                    "text_heading_size_class--4" => "3",
                    "text_heading_text_value--3" => "2",
                    "text_heading_text_value--4" => "3",
                    "text_heading_align_class--3" => "2",
                    "text_heading_align_class--4" => "3",
                    "text_heading_colour_class--3" => "2",
                    "text_heading_colour_class--4" => "3"
                ],
                'image_carousel' => [],
                'paragraph_text' => [],
                'panoramic_image' => [],
                'background_image' => [
                    1 => (new PageComponent\BackgroundImage())
                    ->setBackgroundImage('images/backgrounds/bea90b6a1cf04e25a854428ea0e2564d.jpeg')
                ],
            ]);
        $this->getEntityManager()->persist($page);

        $this->getEntityManager()->flush();
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carousel_slides DROP FOREIGN KEY FK_CA08D1CDB0D24791');
        $this->addSql('DROP TABLE carousel_container');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE carousel_slides');
        $this->addSql('ALTER TABLE pages CHANGE publish publish DATETIME NOT NULL');
    }

    private function getEntityManager(): EntityManagerInterface
    {
        return $this->container->get('doctrine.orm.entity_manager');
    }
}
