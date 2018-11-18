<?php

namespace App\Form\Admin\Config\Entry;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class CreateType
 *
 * @package App\Form\Admin\Config
 */
class EditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value', TextType::class)
            ->add('save', SubmitType::class, [
                'label' => 'Save entry',
                'attr'  => [
                    'class' => 'btn btn-success',
                ],
            ]);

    }
}
