<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/02/2018
 * Time: 14:20
 */

namespace App\Form\Admin\Types;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextHeadingAlignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new \App\Form\DataTransformer\TextHeadingAlignType());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => \App\Entity\Page\TextHeading\AlignClass::class,
        ));
    }


    public function getParent()
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix()
    {
        return 'TextHeadingType';
    }
}
