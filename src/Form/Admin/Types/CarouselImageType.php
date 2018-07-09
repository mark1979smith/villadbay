<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 12/06/2018
 * Time: 12:26
 */

namespace App\Form\Admin\Types;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarouselImageType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder->addModelTransformer(new \App\Form\DataTransformer\CarouselSlideImage());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix()
    {
        return 'CarouselSlideImageType';
    }
}
