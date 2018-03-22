<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 18/01/2018
 * Time: 12:16
 */

namespace App\Form\Admin\Types;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextLeading extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new \App\Form\DataTransformer\TextLeading());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => \App\Entity\Page\TextLead::class,
        ));
    }


    public function getParent()
    {
        return TextareaType::class;
    }

    public function getBlockPrefix()
    {
        return 'TextLeadingType';
    }
}
