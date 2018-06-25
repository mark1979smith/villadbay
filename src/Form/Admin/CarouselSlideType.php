<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 08/06/2018
 * Time: 12:59
 */

namespace App\Form\Admin;


use App\Component\ImageTypes;
use App\Entity\CarouselSlides;
use App\Entity\Image\Type;
use App\Form\Admin\Types\CarouselImageType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarouselSlideType extends AbstractType
{
    use ImageTypes;

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('service_redis');
        $resolver->setRequired('service_aws_s3');
        $resolver->setDefaults(array(
            'data_class' => CarouselSlides::class,
            'submit_button_label' => 'Edit carousel slide'

        ));
        parent::configureOptions($resolver);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var ContainerInterface $container */
        $carouselImages = $this->getCarouselImages($options['service_redis'], $options['service_aws_s3']);

        $builder->add('title', TextType::class, [
            'label'    => 'Header',
            'required' => true,
        ])
        ->add('description', TextareaType::class)
        ->add('image', CarouselImageType::class, [
            'label'       => 'Add Background Image',
            'required'    => false,
            'data_class'  => null,
            'placeholder' => false,
            'choices'     => $carouselImages,

            'expanded' => true,
            'multiple' => false,
        ])
        ->add('send', SubmitType::class, ['label' => $options['submit_button_label']]);
    }

    private function getCarouselImages(\App\Utils\Redis $redisService, \App\Utils\AwsS3Client $s3Service)
    {
        $cacheKey = 'aws.s3.listobjects.' . $s3Service->getBucket();
        if ($redisService->hasItem($cacheKey)) {
            $response = $redisService->getItem($cacheKey)->get();
        } else {
            $response = $s3Service->getImagesBasedOnConfig([
                'Bucket' => $s3Service->getBucket(),
            ]);

            $cacheItem = $redisService->getItem($cacheKey);
            $cacheItem->set($response);

            $redisService->save($cacheItem);
        }

        $carouselImageKeys = [];
        $carouselImageValues = [];
        if (is_iterable($response)) {
            foreach ($response as $asset) {
                if ($this->filterByPath($asset, 'images/' . Type::TYPE_CAROUSEL)) {
                    $carouselImageKeys[] = $asset['CdnUrl'];
                    $carouselImageValues[] = $asset['Metadata']['filename'];
                }
            }
        }

        return array_combine($carouselImageValues, $carouselImageKeys);
    }
}
