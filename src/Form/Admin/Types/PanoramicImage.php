<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 23/01/2018
 * Time: 13:07
 */

namespace App\Form\Admin\Types;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PanoramicImage extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new \App\Form\DataTransformer\PanoramicImage());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => \App\Component\Page\PanoramicImage::class,
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix()
    {
        return 'PanoramicImageType';
    }
}
