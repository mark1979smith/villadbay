<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 17/01/2018
 * Time: 19:59
 */

namespace App\Form\Admin\Types;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DisplayOrder extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer(new \App\Form\DataTransformer\DisplayOrder());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults(array(
            'data_class' => \App\Component\Page\DisplayOrder::class,
        ));
    }


    public function getParent()
    {
        return HiddenType::class;
    }

    public function getBlockPrefix()
    {
        return 'DisplayOrderType';
    }

}
