<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 02/03/2018
 * Time: 13:26
 */

namespace App\Form\Admin;


use App\Component\ImageTypes;
use App\Component\Image\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageTypesType extends AbstractType
{
    use ImageTypes;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('value', ChoiceType::class, array(
            'label'       => 'Select the type of image',
            'choices'     => $this->getImageTypes(),
            'placeholder' => 'Please select',
        ))
            ->add('next', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Type::class,
        ));
    }

}
