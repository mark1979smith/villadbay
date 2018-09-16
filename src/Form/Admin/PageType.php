<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 15/01/2018
 * Time: 21:42
 */

namespace App\Form\Admin;


use App\Component\ImageTypes;
use App\Entity\CarouselContainer;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PageType extends AbstractType
{
    use ImageTypes;

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('container_interface');

        parent::configureOptions($resolver); // TODO: Change the autogenerated stub
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $panoramicImages = $this->getPanoramicImages($options['container_interface']);
        $backgroundImages = $this->getBackgroundImages($options['container_interface']);
        $carousels = $this->getCarousels($options['container_interface']);
        $builder
            ->add('page_route', \App\Form\Admin\Types\PageRoute::class, [
                'label'   => 'Please select the page to edit',
                'choices' => [
                    'Please select' => '',
                    'Homepage'      => 'home',
                    'Search'        => 'search',
                    'About'         => 'about',
                    'Contact'       => 'contact',
                ],
                'attr'    => [
                    'aria-describedby' => 'page_route_helper',
                ],
            ])
            ->add('page_stage', HiddenType::class, [
                'data' => 'core',
            ])
            ->add('page_type', \App\Form\Admin\Types\PageType::class, [
                'label'   => 'Please select the type of page required',
                'choices' => [
                    'Please select' => '',
                    'Landing page'  => 'landing',
                    'Content page'  => 'content',
                ],
                'attr'    => [
                    'aria-describedby' => 'page_type_helper',
                ],
            ])
            ->add('text_heading_type', CollectionType::class, [
                'entry_type'    => \App\Form\Admin\Types\TextHeadingType::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype'     => true,
                'entry_options' => [
                    'choices'  => [
                        'Heading 1' => 'h1',
                        'Heading 2' => 'h2',
                        'Heading 3' => 'h3',
                        'Heading 4' => 'h4',
                        'Heading 5' => 'h5',
                    ],
                    'label'    => 'Choose a heading type',
                    'required' => false,
                ],
                'attr'          => array(
                    'class' => 'js--text_heading_type col-lg-4 col-md-6 col-sm-12',
                    'data-form-element-hide' => 'false',
                ),
            ])
            ->add('text_heading_size_class', CollectionType::class, [
                'entry_type'    => \App\Form\Admin\Types\TextHeadingSizeType::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype'     => true,
                'entry_options' => [
                    'choices'  => [
                        'Display 1' => 'display-1',
                        'Display 2' => 'display-2',
                        'Display 3' => 'display-3',
                        'Display 4' => 'display-4',
                        'Display 5' => 'display-5',
                    ],
                    'label'    => 'Choose a heading size',
                    'required' => false,
                ],
                'attr'          => array(
                    'class' => 'js--text_heading_type col-lg-4 col-md-6 col-sm-12',
                    'data-form-element-hide' => 'false',
                ),
            ])
            ->add('text_heading_colour_class', CollectionType::class, [
                'entry_type'    => \App\Form\Admin\Types\TextHeadingColourType::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype'     => true,
                'entry_options' => [
                    'choices'  => [
                        'Black' => 'text-dark',
                        'Blue' => 'text-primary',
                        'Green' => 'text-success',
                        'Red' => 'text-danger',
                        'Yellow' => 'text-warning',
                        'White' => 'text-white',
                    ],
                    'label'    => 'Choose a heading colour',
                    'required' => false,
                    'placeholder' => false,
                ],
                'attr'          => array(
                    'class' => 'js--text_heading_type col-lg-4 col-md-6 col-sm-12',
                    'data-form-element-hide' => 'false',
                ),
            ])
            ->add('text_heading_align_class', CollectionType::class, [
                'entry_type'    => \App\Form\Admin\Types\TextHeadingAlignType::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype'     => true,
                'entry_options' => [
                    'choices'  => [
                        'Left' => 'text-left',
                        'Centre' => 'text-center',
                        'Right' => 'text-right',
                    ],
                    'label'    => 'Choose a heading alignment',
                    'required' => false,
                    'placeholder' => false,
                ],
                'attr'          => array(
                    'class' => 'js--text_heading_type col-lg-4 col-md-6 col-sm-12',
                    'data-form-element-hide' => 'false',
                ),
            ])
            ->add('text_heading_text_value', CollectionType::class, [
                'entry_type'    => \App\Form\Admin\Types\TextHeadingTextValueType::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype'     => true,
                'entry_options' => [
                    'label'    => 'Enter text for your heading',
                    'required' => false,
                ],
                'attr'          => array(
                    'class' => 'js--text_heading_type col-lg-4 col-md-6 col-sm-12',
                    'data-form-element-hide' => 'false',
                ),
            ])
            ->add('text_leading', CollectionType::class, [
                'entry_type'    => \App\Form\Admin\Types\TextLeading::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype'     => true,
                'entry_options' => [
                    'label'    => 'Enter leading text',
                    'required' => false,
                ],
                'attr' => [
                    'data-form-element-hide' => 'false',
                ],
            ])
            ->add('paragraph_text', CollectionType::class, [
                'entry_type'    => \App\Form\Admin\Types\ParagraphText::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype'     => true,
                'entry_options' => [
                    'label'    => 'Enter text',
                    'required' => false,
                ],
                'attr' => [
                    'data-form-element-hide' => 'false',
                ],

            ])
            ->add('list_group', CollectionType::class, [
                'entry_type'    => \App\Form\Admin\Types\ListGroup::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype'     => true,
                'entry_options' => [
                    'label'      => 'Add List',
                    'required'   => false,
                    'data_class' => null,
                ],
                'attr'          => [
                    'aria-describedby' => 'list_group_helper',
                    'data-form-element-hide' => 'false',
                ],

            ])
            ->add('panoramic_image', CollectionType::class, [
                'entry_type'    => \App\Form\Admin\Types\PanoramicImage::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype'     => true,
                'entry_options' => [
                    'label'      => 'Add Panoramic Image',
                    'required'   => false,
                    'data_class' => null,
                    'choices'    => $panoramicImages,
                    'placeholder' => false,
                    'attr'       => [

                    ],
                ],
                'attr'          => [
                    'aria-describedby' => 'panoramic_image_helper',
                    'data-form-element-prefix-markup' => $this->getPanoramicImagesHtml($panoramicImages),
                    'data-form-element-prefix-markup-append-to' => '.form-group',
                    'data-form-element-hide' => 'select',
                ],

            ])
            ->add('background_image', CollectionType::class, [
                'entry_type'    => \App\Form\Admin\Types\BackgroundImage::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype'     => true,
                'entry_options' => [
                    'label'      => 'Add Background Image',
                    'required'   => false,
                    'data_class' => null,
                    'choices'    => $backgroundImages,
                    'placeholder' => false,
                    'attr'       => [

                    ],
                ],
                'attr'          => [
                    'data-form-element-prefix-markup' => $this->getBackgroundImagesHtml($backgroundImages),
                    'data-form-element-prefix-markup-append-to' => '.form-group',
                    'data-form-element-hide' => 'select',
                ],

            ])
            ->add('form', CollectionType::class, [
                'entry_type'     => \App\Form\Admin\Types\FormType::class,
                'allow_add'      => true,
                'prototype'      => true,
                'entry_options'  => [
                    'label' => 'Add Form',
                    'data_class' => null,
                    'choices'    => [
                        'Search' => 'search-form',
                        'Contact' => 'contact-form',
                    ],
                ],
            ])
            ->add('image_carousel', CollectionType::class, [
                'entry_type'     => \App\Form\Admin\Types\CarouselType::class,
                'allow_add'      => true,
                'prototype'      => true,
                'entry_options'  => [
                    'label' => 'Add Image Carousel',
                    'data_class' => null,
                    'choices'    => $carousels,
                ],
            ])
            ->add('display_order', CollectionType::class, [
                'entry_type'     => \App\Form\Admin\Types\DisplayOrder::class,
                'allow_add'      => true,
                'prototype'      => true,
                'prototype_data' => '#NEWCOUNTER#',
                'entry_options'  => [
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Preview Page',
                'attr'  => [
                    'class'     => 'btn-success btn-block',
                    'data-role' => "core",
                ],
            ]);

    }

    private function getCarousels(ContainerInterface $container)
    {
        /** @var \Doctrine\Common\Persistence\ManagerRegistry $db */
        $db = $container->get('doctrine');
        $carousels = $db->getRepository(CarouselContainer::class)
            ->findAll();

        $entries = [];
        if (is_iterable($carousels)) {
            /** @var CarouselContainer $carousel */
            foreach ($carousels as $carousel) {
                $entries[$carousel->getName()] = $carousel->getId();
            }
        }

        return $entries;


    }

    private function getBackgroundImages(ContainerInterface $container)
    {
        /** @var \App\Utils\Redis $redisService */
        $redisService = $container->get('app.redis');

        /** @var \App\Utils\AwsS3Client $s3Service */
        $s3Service = $container->get('app.aws.s3');

        $cacheKey = 'aws.s3.listobjects.'.$s3Service->getBucket();
        if ($redisService->hasItem($cacheKey)) {
            $response = $redisService->getItem($cacheKey);
        } else {
            $response = $s3Service->getImagesBasedOnConfig([
                'Bucket' => $s3Service->getBucket(),
            ]);

            $cacheItem = $redisService->getItem($cacheKey);
            $cacheItem->set($response);

            $redisService->save($cacheItem);
        }

        switch (get_class($response)) {
            case \Aws\Result::class:
                $serviceData = $response->get('Contents');
                break;

            case CacheItem::class:
                $serviceData = $response->get();
                break;
        }

        $backgroundImages = [];

        if (is_iterable($serviceData)) {
            foreach ($serviceData as $asset) {
                if ($this->filterByPath($asset, 'images/backgrounds')) {
                    $backgroundImages[] = $s3Service->getImageCdn() . DIRECTORY_SEPARATOR . $asset['Key'];
                }
            }
        }


        return array_combine($backgroundImages, $backgroundImages);
    }

    private function getPanoramicImages(ContainerInterface $container)
    {
        /** @var \App\Utils\Redis $redisService */
        $redisService = $container->get('app.redis');

        /** @var \App\Utils\AwsS3Client $s3Service */
        $s3Service = $container->get('app.aws.s3');

        $cacheKey = 'aws.s3.listobjects.'.$s3Service->getBucket();
        if ($redisService->hasItem($cacheKey)) {
            $response = $redisService->getItem($cacheKey);
        } else {
            $response = $s3Service->getImagesBasedOnConfig([
                'Bucket' => $s3Service->getBucket(),
            ]);

            $cacheItem = $redisService->getItem($cacheKey);
            $cacheItem->set($response);

            $redisService->save($cacheItem);
        }

        $panoImages = [];
        switch (get_class($response)) {
            case \Aws\Result::class:
                $serviceData = $response->get('Contents');
                break;

            case CacheItem::class:
                $serviceData = $response->get();
                break;
        }

        if (is_iterable($serviceData)) {
            foreach ($serviceData as $asset) {
                if ($this->filterByPath($asset, 'images/pano')) {
                    $panoImages[] = $s3Service->getImageCdn() . DIRECTORY_SEPARATOR . $asset['Key'];
                }
            }
        }

        return array_combine($panoImages, $panoImages);
    }

    private function getPanoramicImagesHtml(array $panoImages)
    {
        $html = '<div class="card-deck">';

        foreach ($panoImages as $panoImage) {
            $html .= '<div class="card text-center js--card-pano-image">'.
                '<div class="card-body" style="background-position: center; background-size: cover; background-image: url('. $panoImage .');"></div>' .
                '<div class="card-footer btn-group-toggle" data-toggle="buttons"><label class="btn btn-secondary"><input name="do-not-send[]" type="radio" autocomplete="off" value="'. $panoImage .'" /> Select</label></div>' .
                '</div>';
        }

        $html .= '</div>';

        return $html;
    }

    private function getBackgroundImagesHtml(array $backgroundImages)
    {
        $html = '<div class="card-deck">';

        foreach ($backgroundImages as $backgroundImage) {
            $html .= '<div class="card text-center js--card-pano-image">'.
                '<div class="card-body" style="height: 100px; background-position: center; background-size: contain; background-repeat: no-repeat; background-image: url('. $backgroundImage .');"></div>' .
                '<div class="card-footer btn-group-toggle" data-toggle="buttons"><label class="btn btn-secondary"><input name="do-not-send[]" type="radio" autocomplete="off" value="'. $backgroundImage .'" /> Select</label></div>' .
                '</div>';
        }

        $html .= '</div>';

        return $html;
    }
}
