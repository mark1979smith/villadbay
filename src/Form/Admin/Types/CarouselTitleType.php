<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 01/07/2018
 * Time: 21:33
 */

namespace App\Form\Admin\Types;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarouselTitleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder->addViewTransformer(new \App\Form\DataTransformer\CarouselSlideHeading());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
    }


    public function getParent()
    {
        return TextType::class;
    }

    public function getBlockPrefix()
    {
        return 'CarouselSlideTitleType';
    }
}
