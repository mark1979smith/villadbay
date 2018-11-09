<?php
namespace App\Form\Admin\Config;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class EntryType
 *
 * @package App\Form\Admin\Config
 */
class EntryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slug', TextType::class)
            ->add('value', TextType::class)
            ->add('save', SubmitType::class, [
                'label' => 'Create new entry',
                'attr'  => [
                    'class' => 'btn btn-success',
                ],
            ]);
    }
}
