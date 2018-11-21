<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 19/02/2018
 * Time: 19:44
 */

namespace App\Form\Admin\Types;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CarouselType extends AbstractType
{
    /** @var \App\Form\DataTransformer\CarouselType  */
    private $transformer;

    public function __construct(\App\Form\DataTransformer\CarouselType $transformer)
    {
        $this->transformer = $transformer;

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => \App\Component\Page\Carousel::class,
        ));
    }


    public function getParent()
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix()
    {
        return 'CarouselType';
    }

}
