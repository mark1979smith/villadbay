<?php declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\CarouselContainer;
use App\Entity\CarouselSlides;
use App\Entity\Page;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180928123234 extends AbstractMigration implements ContainerAwareInterface
{


    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE carousel_container (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, contact_name VARCHAR(100) NOT NULL, contact_address VARCHAR(255) NOT NULL, contact_number VARCHAR(30) NOT NULL, alternative_contact_number VARCHAR(30) DEFAULT NULL, fax_number VARCHAR(30) DEFAULT NULL, email_address VARCHAR(255) NOT NULL, check_in DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', check_out DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', time_of_arrival TIME NOT NULL, adults SMALLINT NOT NULL, children SMALLINT NOT NULL, total_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carousel_slides (id INT AUTO_INCREMENT NOT NULL, carousel_id_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_CA08D1CDB0D24791 (carousel_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carousel_slides ADD CONSTRAINT FK_CA08D1CDB0D24791 FOREIGN KEY (carousel_id_id) REFERENCES carousel_container (id)');
        $this->addSql('ALTER TABLE pages CHANGE publish publish DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');

        $carouselContainerClassName = $this->getEntityManager()->getRepository(CarouselContainer::class)->getClassName();
        /** @var CarouselContainer $carouselContainer */
        $carouselContainer = new $carouselContainerClassName;
        $carouselContainer->setName('Our Villa');
        $this->getEntityManager()->persist($carouselContainer);

        $carouselSlidesClassName = $this->getEntityManager()->getRepository(CarouselSlides::class)->getClassName();
        /** @var CarouselSlides $carouselSlides */
        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/8144771dbbc5ba13a64d6b76b5bf0b47.jpeg')
            ->setPosition(1);
        $this->getEntityManager()->persist($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/e26c6d1ba38a47c6c2ea185a9f9a01c4.jpeg')
            ->setPosition(2);
        $this->getEntityManager()->persist($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/8ae7c70fc01343a733423745b666f2bc.jpeg')
            ->setPosition(3);
        $this->getEntityManager()->persist($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/73d5d5ce3baca995f18ee7c0bece1093.jpeg')
            ->setPosition(4);
        $this->getEntityManager()->persist($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/51bf751a6468018bdd6084ebac60d396.jpeg')
            ->setPosition(5);
        $this->getEntityManager()->persist($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/68b396a4064a7fc581575eeee2a5120b.jpeg')
            ->setPosition(6);
        $this->getEntityManager()->persist($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/48feb56f98b7cfbb95a1542240b97abb.jpeg')
            ->setPosition(7);
        $this->getEntityManager()->persist($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/9cedf82a08b3f1c4ca9eff52760d87cd.jpeg')
            ->setPosition(8);
        $this->getEntityManager()->persist($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/bb93edfe1fe404be10b40eb9158fcf7d.jpeg')
            ->setPosition(9);
        $this->getEntityManager()->persist($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/d86f2cea976a9edac387bc798aff5197.jpeg')
            ->setPosition(10);
        $this->getEntityManager()->persist($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/27fa5e5325847db75a57331eb2c259c2.jpeg')
            ->setPosition(11);
        $this->getEntityManager()->persist($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/a726f76d96b188cc2e047ec5e0571c39.jpeg')
            ->setPosition(12);
        $this->getEntityManager()->persist($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/a7bd669f84016a4a055d71f3500d8f4c.jpeg')
            ->setPosition(13);
        $this->getEntityManager()->persist($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/8f087120c8e12e416c1a5ceed2693f8f.jpeg')
            ->setPosition(14);
        $this->getEntityManager()->persist($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/5dd1b7fa071d9cfe5254cd6c06e67ac8.jpeg')
            ->setPosition(15);
        $this->getEntityManager()->persist($carouselSlides);

        $carouselSlides = new $carouselSlidesClassName;
        $carouselSlides->setCarouselId($carouselContainer->getId())
            ->setImage('images/carousel/72db37029f7f34d8442391129e4c17a9.jpeg')
            ->setPosition(16);
        $this->getEntityManager()->persist($carouselSlides);

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
                'page_type' => (new Page\PageType())->setPageType('content'),
                'form' => [
                    4 => 'search-form'
                ],
                'list_group' => [],
                'page_route' => (new Page\PageRoute())->setPageRoute('search'),
                'page_stage' => 'options',
                'text_heading' => [2 => (new Page\TextHeading())
                    ->setType((new Page\TextHeading\Type())->setValue('h1'))
                    ->setSizeClass((new Page\TextHeading\SizeClass())->setValue('display-3'))
                    ->setColourClass((new Page\TextHeading\ColourClass())->setValue('text-dark'))
                    ->setAlignClass((new Page\TextHeading\AlignClass())->setValue('text-left'))
                    ->setTextValue((new Page\TextHeading\TextValue())->setValue('Search Availability'))],
                'text_leading'=> [3 => (new Page\TextLead())
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
                    1 => (new Page\PanoramicImage())
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
                    4 => 'search-form'
                ],
                'page_type' => (new Page\PageType())->setPageType('content'),
                'list_group' => [],
                'page_route' => (new Page\PageRoute())->setPageRoute('contact'),
                'page_stage' => 'options',
                'text_heading' => [
                    2 => (new Page\TextHeading())
                    ->setType((new Page\TextHeading\Type())->setValue('h1'))
                    ->setSizeClass((new Page\TextHeading\SizeClass())->setValue('display-3'))
                    ->setColourClass((new Page\TextHeading\ColourClass())->setValue('text-dark'))
                    ->setAlignClass((new Page\TextHeading\AlignClass())->setValue('text-left'))
                    ->setTextValue((new Page\TextHeading\TextValue())->setValue('Contact the Villa'))
                ],
                'text_leading' => [
                    3 => (new Page\TextLead())->setTextValue('Should you have any questions please don\'t hesitate to contact us.')
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
                    1 => (new Page\PanoramicImage())->setPanoramicImage('images/pano/af7bb474323ab24ad8f99d890255f976.jpeg')
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
                'page_type' => (new Page\PageType())->setPageType('content'),
                'list_group' => [
                    8 => (new Page\ListGroup())->setListItems([
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
                'page_route' => (new Page\PageRoute())->setPageRoute('about'),
                'page_stage' => 'options',
                'text_heading' => [
                    1 => (new Page\TextHeading())
                        ->setType((new Page\TextHeading\Type())->setValue('h1'))
                        ->setSizeClass((new Page\TextHeading\SizeClass())->setValue('display-3'))
                        ->setColourClass((new Page\TextHeading\ColourClass())->setValue('text-dark'))
                        ->setAlignClass((new Page\TextHeading\AlignClass())->setValue('text-left'))
                        ->setTextValue((new Page\TextHeading\TextValue())->setValue('About the Villa at The Bay'))
                ],
                'text_leading' => [
                    2 => (new Page\TextLead())->setTextValue('Situated in Deception Bay in the Queensland region, The Villa at The Bay is a villa featuring a patio and garden views.')
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
                    5 => (new Page\ParagraphText())->setTextValue('The accommodation is 33 km from Brisbane, and guests benefit from complimentary WiFi and private parking available on site.'),
                    6 => (new Page\ParagraphText())->setTextValue('The villa is equipped with 1 separate bedroom and includes a kitchen with an oven and a dining area. The villa also offers a flat-screen TV, a seating area, and a bathroom with a shower.'),
                    7 => (new Page\ParagraphText())->setTextValue('Margate is 13 km from The Villa at The Bay, while Caloundra is 43 km from the property. Brisbane Airport is 26 km away.')
                ],
                'panoramic_image' => [
                    4 => (new Page\PanoramicImage())->setPanoramicImage('images/pano/af7bb474323ab24ad8f99d890255f976.jpeg')
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
                'page_type' => (new Page\PageType())->setPageType('landing'),
                'list_group' => [],
                'page_stage' => 'options',
                'page_route' => (new Page\PageRoute())->setPageRoute('home'),
                'text_heading' => [
                    3 => (new Page\TextHeading())
                        ->setType((new Page\TextHeading\Type())->setValue('h1'))
                        ->setSizeClass((new Page\TextHeading\SizeClass())->setValue('display-3'))
                        ->setColourClass((new Page\TextHeading\ColourClass())->setValue('text-dark'))
                        ->setAlignClass((new Page\TextHeading\AlignClass())->setValue('text-center'))
                        ->setTextValue((new Page\TextHeading\TextValue())->setValue('The Villa at The Bay')),
                    4 => (new Page\TextHeading())
                        ->setType((new Page\TextHeading\Type())->setValue('h3'))
                        ->setSizeClass((new Page\TextHeading\SizeClass())->setValue('display-5'))
                        ->setColourClass((new Page\TextHeading\ColourClass())->setValue('text-white'))
                        ->setAlignClass((new Page\TextHeading\AlignClass())->setValue('text-center'))
                        ->setTextValue((new Page\TextHeading\TextValue())->setValue('LIFE AS IT SHOULD BE')),
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
                    1 => (new Page\BackgroundImage())
                    ->setBackgroundImage('images/backgrounds/bea90b6a1cf04e25a854428ea0e2564d.jpeg')
                ],
            ]);
        $this->getEntityManager()->persist($page);

        $this->getEntityManager()->flush();
//        $this->addSql("INSERT INTO `carousel_container` VALUES (2,'Our Villa',NULL);");
//        $this->addSql("INSERT INTO `carousel_slides` VALUES (57,2,NULL,NULL,'images/carousel/8144771dbbc5ba13a64d6b76b5bf0b47.jpeg'),(58,2,NULL,NULL,'images/carousel/e26c6d1ba38a47c6c2ea185a9f9a01c4.jpeg'),(59,2,NULL,NULL,'images/carousel/8ae7c70fc01343a733423745b666f2bc.jpeg'),(60,2,NULL,NULL,'images/carousel/73d5d5ce3baca995f18ee7c0bece1093.jpeg'),(61,2,NULL,NULL,'images/carousel/51bf751a6468018bdd6084ebac60d396.jpeg'),(62,2,NULL,NULL,'images/carousel/68b396a4064a7fc581575eeee2a5120b.jpeg'),(63,2,NULL,NULL,'images/carousel/48feb56f98b7cfbb95a1542240b97abb.jpeg'),(64,2,NULL,NULL,'images/carousel/9cedf82a08b3f1c4ca9eff52760d87cd.jpeg'),(65,2,NULL,NULL,'images/carousel/bb93edfe1fe404be10b40eb9158fcf7d.jpeg'),(66,2,NULL,NULL,'images/carousel/d86f2cea976a9edac387bc798aff5197.jpeg'),(67,2,NULL,NULL,'images/carousel/27fa5e5325847db75a57331eb2c259c2.jpeg'),(68,2,NULL,NULL,'images/carousel/a726f76d96b188cc2e047ec5e0571c39.jpeg'),(69,2,NULL,NULL,'images/carousel/a7bd669f84016a4a055d71f3500d8f4c.jpeg'),(70,2,NULL,NULL,'images/carousel/8f087120c8e12e416c1a5ceed2693f8f.jpeg'),(71,2,NULL,NULL,'images/carousel/5dd1b7fa071d9cfe5254cd6c06e67ac8.jpeg'),(72,2,NULL,NULL,'images/carousel/72db37029f7f34d8442391129e4c17a9.jpeg');");
//        $this->addSql("INSERT INTO `pages` VALUES (133,'search','{\"form\": {\"4\": \"search-form\"}, \"page_type\": \"O:24:\\\"App\\\\Entity\\\\Page\\\\PageType\\\":1:{s:34:\\\"\\u0000App\\\\Entity\\\\Page\\\\PageType\\u0000pageType\\\";s:7:\\\"content\\\";}\", \"list_group\": [], \"page_route\": \"O:25:\\\"App\\\\Entity\\\\Page\\\\PageRoute\\\":1:{s:36:\\\"\\u0000App\\\\Entity\\\\Page\\\\PageRoute\\u0000pageRoute\\\";s:6:\\\"search\\\";}\", \"page_stage\": \"options\", \"text_heading\": {\"2\": \"O:27:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\":6:{s:37:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000template\\\";s:97:\\\"<div class=\\\"container\\\"><div class=\\\"row\\\"><div class=\\\"col\\\"><%s class=\\\"%s\\\">%s</%s></div></div></div>\\\";s:33:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000type\\\";O:32:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\\":1:{s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\u0000value\\\";s:2:\\\"h1\\\";}s:38:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000sizeClass\\\";O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\u0000value\\\";s:9:\\\"display-3\\\";}s:40:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000colourClass\\\";O:39:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\\":1:{s:46:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\u0000value\\\";s:9:\\\"text-dark\\\";}s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000alignClass\\\";O:38:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\\":1:{s:45:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\u0000value\\\";s:9:\\\"text-left\\\";}s:38:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000textValue\\\";O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\u0000value\\\";s:19:\\\"Search Availability\\\";}}\"}, \"text_leading\": {\"3\": \"O:24:\\\"App\\\\Entity\\\\Page\\\\TextLead\\\":2:{s:34:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextLead\\u0000template\\\";s:97:\\\"<div class=\\\"container\\\"><div class=\\\"row\\\"><div class=\\\"col\\\"><p class=\\\"lead\\\">%s</p></div></div></div>\\\";s:35:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextLead\\u0000textValue\\\";s:273:\\\"With it\'s spacious feel and luxurious Queen bed, our Executive room is perfect if you\\r\\n                    like to stretch out and relax. There is a comfortable seating area, along with luxurious bedding\\r\\n                    that will guarantee you a great night’s sleep.\\\";}\"}, \"display_order\": {\"0\": \"0\", \"form--4\": \"4\", \"text_leading--3\": \"3\", \"panoramic_image--1\": \"1\", \"text_heading_type--2\": \"2\", \"text_heading_size_class--2\": \"2\", \"text_heading_text_value--2\": \"2\", \"text_heading_align_class--2\": \"2\", \"text_heading_colour_class--2\": \"2\"}, \"image_carousel\": [], \"paragraph_text\": [], \"panoramic_image\": {\"1\": \"O:30:\\\"App\\\\Entity\\\\Page\\\\PanoramicImage\\\":2:{s:40:\\\"\\u0000App\\\\Entity\\\\Page\\\\PanoramicImage\\u0000template\\\";s:101:\\\"<div class=\\\"container-fluid\\\"><div class=\\\"row\\\"><div class=\\\"col img-fluid\\\" id=\\\"pano\\\"></div></div></div>\\\";s:46:\\\"\\u0000App\\\\Entity\\\\Page\\\\PanoramicImage\\u0000panoramicImage\\\";s:87:\\\"https://d1dkx0epoz0ees.cloudfront.net/images/pano/a0dd58cab182c901b644e34e75be7ce5.jpeg\\\";}\"}, \"background_image\": [], \"text_heading_type\": {\"2\": \"O:32:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\\":1:{s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\u0000value\\\";s:2:\\\"h1\\\";}\"}, \"text_heading_size_class\": {\"2\": \"O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\u0000value\\\";s:9:\\\"display-3\\\";}\"}, \"text_heading_text_value\": {\"2\": \"O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\u0000value\\\";s:19:\\\"Search Availability\\\";}\"}, \"text_heading_align_class\": {\"2\": \"O:38:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\\":1:{s:45:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\u0000value\\\";s:9:\\\"text-left\\\";}\"}, \"text_heading_colour_class\": {\"2\": \"O:39:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\\":1:{s:46:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\u0000value\\\";s:9:\\\"text-dark\\\";}\"}}','2018-09-25 17:12:57',0),(135,'contact','{\"form\": {\"4\": \"search-form\"}, \"page_type\": \"O:24:\\\"App\\\\Entity\\\\Page\\\\PageType\\\":1:{s:34:\\\"\\u0000App\\\\Entity\\\\Page\\\\PageType\\u0000pageType\\\";s:7:\\\"content\\\";}\", \"list_group\": [], \"page_route\": \"O:25:\\\"App\\\\Entity\\\\Page\\\\PageRoute\\\":1:{s:36:\\\"\\u0000App\\\\Entity\\\\Page\\\\PageRoute\\u0000pageRoute\\\";s:7:\\\"contact\\\";}\", \"page_stage\": \"options\", \"text_heading\": {\"2\": \"O:27:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\":6:{s:37:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000template\\\";s:97:\\\"<div class=\\\"container\\\"><div class=\\\"row\\\"><div class=\\\"col\\\"><%s class=\\\"%s\\\">%s</%s></div></div></div>\\\";s:33:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000type\\\";O:32:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\\":1:{s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\u0000value\\\";s:2:\\\"h1\\\";}s:38:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000sizeClass\\\";O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\u0000value\\\";s:9:\\\"display-3\\\";}s:40:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000colourClass\\\";O:39:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\\":1:{s:46:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\u0000value\\\";s:9:\\\"text-dark\\\";}s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000alignClass\\\";O:38:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\\":1:{s:45:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\u0000value\\\";s:9:\\\"text-left\\\";}s:38:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000textValue\\\";O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\u0000value\\\";s:17:\\\"Contact the Villa\\\";}}\"}, \"text_leading\": {\"3\": \"O:24:\\\"App\\\\Entity\\\\Page\\\\TextLead\\\":2:{s:34:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextLead\\u0000template\\\";s:97:\\\"<div class=\\\"container\\\"><div class=\\\"row\\\"><div class=\\\"col\\\"><p class=\\\"lead\\\">%s</p></div></div></div>\\\";s:35:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextLead\\u0000textValue\\\";s:66:\\\"Should you have any questions please don\'t hesitate to contact us.\\\";}\"}, \"display_order\": {\"0\": \"0\", \"form--4\": \"4\", \"text_leading--3\": \"3\", \"panoramic_image--1\": \"1\", \"text_heading_type--2\": \"2\", \"text_heading_size_class--2\": \"2\", \"text_heading_text_value--2\": \"2\", \"text_heading_align_class--2\": \"2\", \"text_heading_colour_class--2\": \"2\"}, \"image_carousel\": [], \"paragraph_text\": [], \"panoramic_image\": {\"1\": \"O:30:\\\"App\\\\Entity\\\\Page\\\\PanoramicImage\\\":2:{s:40:\\\"\\u0000App\\\\Entity\\\\Page\\\\PanoramicImage\\u0000template\\\";s:101:\\\"<div class=\\\"container-fluid\\\"><div class=\\\"row\\\"><div class=\\\"col img-fluid\\\" id=\\\"pano\\\"></div></div></div>\\\";s:46:\\\"\\u0000App\\\\Entity\\\\Page\\\\PanoramicImage\\u0000panoramicImage\\\";s:87:\\\"https://d1dkx0epoz0ees.cloudfront.net/images/pano/af7bb474323ab24ad8f99d890255f976.jpeg\\\";}\"}, \"background_image\": [], \"text_heading_type\": {\"2\": \"O:32:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\\":1:{s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\u0000value\\\";s:2:\\\"h1\\\";}\"}, \"text_heading_size_class\": {\"2\": \"O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\u0000value\\\";s:9:\\\"display-3\\\";}\"}, \"text_heading_text_value\": {\"2\": \"O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\u0000value\\\";s:17:\\\"Contact the Villa\\\";}\"}, \"text_heading_align_class\": {\"2\": \"O:38:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\\":1:{s:45:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\u0000value\\\";s:9:\\\"text-left\\\";}\"}, \"text_heading_colour_class\": {\"2\": \"O:39:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\\":1:{s:46:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\u0000value\\\";s:9:\\\"text-dark\\\";}\"}}','2018-09-25 17:19:47',0),(137,'about','{\"form\": [], \"page_type\": \"O:24:\\\"App\\\\Entity\\\\Page\\\\PageType\\\":1:{s:34:\\\"\\u0000App\\\\Entity\\\\Page\\\\PageType\\u0000pageType\\\";s:7:\\\"content\\\";}\", \"list_group\": {\"8\": \"O:25:\\\"App\\\\Entity\\\\Page\\\\ListGroup\\\":3:{s:35:\\\"\\u0000App\\\\Entity\\\\Page\\\\ListGroup\\u0000template\\\";s:97:\\\"<div class=\\\"container\\\"><div class=\\\"row\\\"><div class=\\\"col\\\"><ul class=\\\"%s\\\">%s</ul></div></div></div>\\\";s:35:\\\"\\u0000App\\\\Entity\\\\Page\\\\ListGroup\\u0000cssClass\\\";s:27:\\\"list-group list-group-flush\\\";s:36:\\\"\\u0000App\\\\Entity\\\\Page\\\\ListGroup\\u0000listItems\\\";a:10:{i:0;s:25:\\\"Free resident car parking\\\";i:1;s:20:\\\"Fully Self contained\\\";i:2;s:17:\\\"Free WI-FI access\\\";i:3;s:26:\\\"24 hour check-in available\\\";i:4;s:17:\\\"Business services\\\";i:5;s:14:\\\"Flat screen TV\\\";i:6;s:18:\\\"Laundry facilities\\\";i:7;s:10:\\\"DVD player\\\";i:8;s:30:\\\"Tea & coffee making facilities\\\";i:9;s:20:\\\"Iron & ironing board\\\";}}\"}, \"page_route\": \"O:25:\\\"App\\\\Entity\\\\Page\\\\PageRoute\\\":1:{s:36:\\\"\\u0000App\\\\Entity\\\\Page\\\\PageRoute\\u0000pageRoute\\\";s:5:\\\"about\\\";}\", \"page_stage\": \"options\", \"text_heading\": {\"1\": \"O:27:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\":6:{s:37:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000template\\\";s:97:\\\"<div class=\\\"container\\\"><div class=\\\"row\\\"><div class=\\\"col\\\"><%s class=\\\"%s\\\">%s</%s></div></div></div>\\\";s:33:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000type\\\";O:32:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\\":1:{s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\u0000value\\\";s:2:\\\"h1\\\";}s:38:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000sizeClass\\\";O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\u0000value\\\";s:9:\\\"display-3\\\";}s:40:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000colourClass\\\";O:39:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\\":1:{s:46:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\u0000value\\\";s:9:\\\"text-dark\\\";}s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000alignClass\\\";O:38:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\\":1:{s:45:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\u0000value\\\";s:9:\\\"text-left\\\";}s:38:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000textValue\\\";O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\u0000value\\\";s:26:\\\"About the Villa at The Bay\\\";}}\"}, \"text_leading\": {\"2\": \"O:24:\\\"App\\\\Entity\\\\Page\\\\TextLead\\\":2:{s:34:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextLead\\u0000template\\\";s:97:\\\"<div class=\\\"container\\\"><div class=\\\"row\\\"><div class=\\\"col\\\"><p class=\\\"lead\\\">%s</p></div></div></div>\\\";s:35:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextLead\\u0000textValue\\\";s:161:\\\"Situated in Deception Bay in the Queensland region, The Villa at The Bay is a villa\\r\\n                    featuring a patio\\r\\n                    and garden views.\\\";}\"}, \"display_order\": {\"0\": \"0\", \"list_group--8\": \"7\", \"text_leading--2\": \"3\", \"image_carousel--9\": \"8\", \"paragraph_text--5\": \"4\", \"paragraph_text--6\": \"5\", \"paragraph_text--7\": \"6\", \"panoramic_image--4\": \"1\", \"text_heading_type--1\": \"2\", \"text_heading_size_class--1\": \"2\", \"text_heading_text_value--1\": \"2\", \"text_heading_align_class--1\": \"2\", \"text_heading_colour_class--1\": \"2\"}, \"image_carousel\": {\"9\": \"O:28:\\\"App\\\\Entity\\\\CarouselContainer\\\":5:{s:38:\\\"\\u0000App\\\\Entity\\\\CarouselContainer\\u0000template\\\";s:640:\\\"<div class=\\\"container\\\"><div class=\\\"row\\\"><div class=\\\"col\\\"><div id=\\\"carouselVillaIndicators\\\" class=\\\"carousel slide\\\" data-ride=\\\"carousel\\\"><ol class=\\\"carousel-indicators\\\">%s</ol><div class=\\\"carousel-inner\\\">%s</div><a class=\\\"carousel-control-prev\\\" href=\\\"#carouselVillaIndicators\\\" role=\\\"button\\\" data-slide=\\\"prev\\\"><span class=\\\"carousel-control-prev-icon\\\" aria-hidden=\\\"true\\\"></span><span class=\\\"sr-only\\\">Previous</span></a><a class=\\\"carousel-control-next\\\" href=\\\"#carouselVillaIndicators\\\" role=\\\"button\\\" data-slide=\\\"next\\\"><span class=\\\"carousel-control-next-icon\\\" aria-hidden=\\\"true\\\"></span><span class=\\\"sr-only\\\">Next</span></a></div></div></div></div>\\\";s:32:\\\"\\u0000App\\\\Entity\\\\CarouselContainer\\u0000id\\\";i:2;s:34:\\\"\\u0000App\\\\Entity\\\\CarouselContainer\\u0000name\\\";s:9:\\\"Our Villa\\\";s:41:\\\"\\u0000App\\\\Entity\\\\CarouselContainer\\u0000description\\\";N;s:44:\\\"\\u0000App\\\\Entity\\\\CarouselContainer\\u0000carouselSlides\\\";O:33:\\\"Doctrine\\\\ORM\\\\PersistentCollection\\\":2:{s:13:\\\"\\u0000*\\u0000collection\\\";O:43:\\\"Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\\":1:{s:53:\\\"\\u0000Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\u0000elements\\\";a:16:{i:0;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:57;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/8144771dbbc5ba13a64d6b76b5bf0b47.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}i:1;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:58;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/e26c6d1ba38a47c6c2ea185a9f9a01c4.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}i:2;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:59;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/8ae7c70fc01343a733423745b666f2bc.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}i:3;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:60;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/73d5d5ce3baca995f18ee7c0bece1093.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}i:4;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:61;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/51bf751a6468018bdd6084ebac60d396.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}i:5;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:62;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/68b396a4064a7fc581575eeee2a5120b.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}i:6;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:63;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/48feb56f98b7cfbb95a1542240b97abb.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}i:7;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:64;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/9cedf82a08b3f1c4ca9eff52760d87cd.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}i:8;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:65;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/bb93edfe1fe404be10b40eb9158fcf7d.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}i:9;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:66;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/d86f2cea976a9edac387bc798aff5197.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}i:10;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:67;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/27fa5e5325847db75a57331eb2c259c2.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}i:11;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:68;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/a726f76d96b188cc2e047ec5e0571c39.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}i:12;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:69;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/a7bd669f84016a4a055d71f3500d8f4c.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}i:13;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:70;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/8f087120c8e12e416c1a5ceed2693f8f.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}i:14;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:71;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/5dd1b7fa071d9cfe5254cd6c06e67ac8.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}i:15;O:25:\\\"App\\\\Entity\\\\CarouselSlides\\\":6:{s:29:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000id\\\";i:72;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000carousel_id\\\";r:1;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000title\\\";N;s:38:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000description\\\";N;s:32:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000image\\\";s:53:\\\"images/carousel/72db37029f7f34d8442391129e4c17a9.jpeg\\\";s:35:\\\"\\u0000App\\\\Entity\\\\CarouselSlides\\u0000position\\\";N;}}}s:14:\\\"\\u0000*\\u0000initialized\\\";b:1;}}\"}, \"paragraph_text\": {\"5\": \"O:29:\\\"App\\\\Entity\\\\Page\\\\ParagraphText\\\":2:{s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\ParagraphText\\u0000template\\\";s:84:\\\"<div class=\\\"container\\\"><div class=\\\"row\\\"><div class=\\\"col\\\"><p>%s</p></div></div></div>\\\";s:40:\\\"\\u0000App\\\\Entity\\\\Page\\\\ParagraphText\\u0000textValue\\\";s:144:\\\"The accommodation is 33 km from Brisbane, and guests benefit from complimentary\\r\\n                    WiFi and private parking available on site.\\\";}\", \"6\": \"O:29:\\\"App\\\\Entity\\\\Page\\\\ParagraphText\\\":2:{s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\ParagraphText\\u0000template\\\";s:84:\\\"<div class=\\\"container\\\"><div class=\\\"row\\\"><div class=\\\"col\\\"><p>%s</p></div></div></div>\\\";s:40:\\\"\\u0000App\\\\Entity\\\\Page\\\\ParagraphText\\u0000textValue\\\";s:207:\\\"The villa is equipped with 1 separate bedroom and includes a kitchen with an oven and a dining area.\\r\\n                    The villa also offers a flat-screen TV, a seating area, and a bathroom with a shower.\\\";}\", \"7\": \"O:29:\\\"App\\\\Entity\\\\Page\\\\ParagraphText\\\":2:{s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\ParagraphText\\u0000template\\\";s:84:\\\"<div class=\\\"container\\\"><div class=\\\"row\\\"><div class=\\\"col\\\"><p>%s</p></div></div></div>\\\";s:40:\\\"\\u0000App\\\\Entity\\\\Page\\\\ParagraphText\\u0000textValue\\\";s:140:\\\"Margate is 13 km from The Villa at The Bay, while Caloundra is 43 km from the property. Brisbane\\r\\n                    Airport is 26 km away.\\\";}\"}, \"panoramic_image\": {\"4\": \"O:30:\\\"App\\\\Entity\\\\Page\\\\PanoramicImage\\\":2:{s:40:\\\"\\u0000App\\\\Entity\\\\Page\\\\PanoramicImage\\u0000template\\\";s:101:\\\"<div class=\\\"container-fluid\\\"><div class=\\\"row\\\"><div class=\\\"col img-fluid\\\" id=\\\"pano\\\"></div></div></div>\\\";s:46:\\\"\\u0000App\\\\Entity\\\\Page\\\\PanoramicImage\\u0000panoramicImage\\\";s:87:\\\"https://d1dkx0epoz0ees.cloudfront.net/images/pano/adbff1a287b6515495f3431065c7d1b3.jpeg\\\";}\"}, \"background_image\": [], \"text_heading_type\": {\"1\": \"O:32:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\\":1:{s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\u0000value\\\";s:2:\\\"h1\\\";}\"}, \"text_heading_size_class\": {\"1\": \"O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\u0000value\\\";s:9:\\\"display-3\\\";}\"}, \"text_heading_text_value\": {\"1\": \"O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\u0000value\\\";s:26:\\\"About the Villa at The Bay\\\";}\"}, \"text_heading_align_class\": {\"1\": \"O:38:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\\":1:{s:45:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\u0000value\\\";s:9:\\\"text-left\\\";}\"}, \"text_heading_colour_class\": {\"1\": \"O:39:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\\":1:{s:46:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\u0000value\\\";s:9:\\\"text-dark\\\";}\"}}','2018-09-28 22:11:01',0),(138,'home','{\"form\": {\"2\": \"search-form\"}, \"page_type\": \"O:24:\\\"App\\\\Entity\\\\Page\\\\PageType\\\":1:{s:34:\\\"\\u0000App\\\\Entity\\\\Page\\\\PageType\\u0000pageType\\\";s:7:\\\"landing\\\";}\", \"list_group\": [], \"page_route\": \"O:25:\\\"App\\\\Entity\\\\Page\\\\PageRoute\\\":1:{s:36:\\\"\\u0000App\\\\Entity\\\\Page\\\\PageRoute\\u0000pageRoute\\\";s:4:\\\"home\\\";}\", \"page_stage\": \"options\", \"text_heading\": {\"3\": \"O:27:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\":6:{s:37:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000template\\\";s:97:\\\"<div class=\\\"container\\\"><div class=\\\"row\\\"><div class=\\\"col\\\"><%s class=\\\"%s\\\">%s</%s></div></div></div>\\\";s:33:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000type\\\";O:32:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\\":1:{s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\u0000value\\\";s:2:\\\"h1\\\";}s:38:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000sizeClass\\\";O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\u0000value\\\";s:9:\\\"display-3\\\";}s:40:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000colourClass\\\";O:39:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\\":1:{s:46:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\u0000value\\\";s:12:\\\"text-primary\\\";}s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000alignClass\\\";O:38:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\\":1:{s:45:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\u0000value\\\";s:11:\\\"text-center\\\";}s:38:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000textValue\\\";O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\u0000value\\\";s:20:\\\"The Villa at The Bay\\\";}}\", \"4\": \"O:27:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\":6:{s:37:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000template\\\";s:97:\\\"<div class=\\\"container\\\"><div class=\\\"row\\\"><div class=\\\"col\\\"><%s class=\\\"%s\\\">%s</%s></div></div></div>\\\";s:33:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000type\\\";O:32:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\\":1:{s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\u0000value\\\";s:2:\\\"h3\\\";}s:38:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000sizeClass\\\";O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\u0000value\\\";s:9:\\\"display-5\\\";}s:40:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000colourClass\\\";O:39:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\\":1:{s:46:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\u0000value\\\";s:10:\\\"text-white\\\";}s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000alignClass\\\";O:38:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\\":1:{s:45:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\u0000value\\\";s:11:\\\"text-center\\\";}s:38:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\u0000textValue\\\";O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\u0000value\\\";s:20:\\\"LIFE AS IT SHOULD BE\\\";}}\"}, \"text_leading\": [], \"display_order\": {\"0\": \"0\", \"form--2\": \"4\", \"background_image--1\": \"1\", \"text_heading_type--3\": \"2\", \"text_heading_type--4\": \"3\", \"text_heading_size_class--3\": \"2\", \"text_heading_size_class--4\": \"3\", \"text_heading_text_value--3\": \"2\", \"text_heading_text_value--4\": \"3\", \"text_heading_align_class--3\": \"2\", \"text_heading_align_class--4\": \"3\", \"text_heading_colour_class--3\": \"2\", \"text_heading_colour_class--4\": \"3\"}, \"image_carousel\": [], \"paragraph_text\": [], \"panoramic_image\": [], \"background_image\": {\"1\": \"O:31:\\\"App\\\\Entity\\\\Page\\\\BackgroundImage\\\":1:{s:48:\\\"\\u0000App\\\\Entity\\\\Page\\\\BackgroundImage\\u0000backgroundImage\\\";s:94:\\\"https://d1dkx0epoz0ees.cloudfront.net/images/backgrounds/bea90b6a1cf04e25a854428ea0e2564d.jpeg\\\";}\"}, \"text_heading_type\": {\"3\": \"O:32:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\\":1:{s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\u0000value\\\";s:2:\\\"h1\\\";}\", \"4\": \"O:32:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\\":1:{s:39:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\Type\\u0000value\\\";s:2:\\\"h3\\\";}\"}, \"text_heading_size_class\": {\"3\": \"O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\u0000value\\\";s:9:\\\"display-3\\\";}\", \"4\": \"O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\SizeClass\\u0000value\\\";s:9:\\\"display-5\\\";}\"}, \"text_heading_text_value\": {\"3\": \"O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\u0000value\\\";s:20:\\\"The Villa at The Bay\\\";}\", \"4\": \"O:37:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\\":1:{s:44:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\TextValue\\u0000value\\\";s:20:\\\"LIFE AS IT SHOULD BE\\\";}\"}, \"text_heading_align_class\": {\"3\": \"O:38:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\\":1:{s:45:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\u0000value\\\";s:11:\\\"text-center\\\";}\", \"4\": \"O:38:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\\":1:{s:45:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\AlignClass\\u0000value\\\";s:11:\\\"text-center\\\";}\"}, \"text_heading_colour_class\": {\"3\": \"O:39:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\\":1:{s:46:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\u0000value\\\";s:12:\\\"text-primary\\\";}\", \"4\": \"O:39:\\\"App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\\":1:{s:46:\\\"\\u0000App\\\\Entity\\\\Page\\\\TextHeading\\\\ColourClass\\u0000value\\\";s:10:\\\"text-white\\\";}\"}}','2018-09-28 22:43:34',0);");

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
