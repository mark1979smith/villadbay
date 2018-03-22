<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 22/02/2018
 * Time: 09:31
 */

namespace App\Form\Admin;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ApprovePageRevision extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slug', HiddenType::class)
            ->add('approve', SubmitType::class, [
                'label' => 'Yes',
                'attr'  => [
                    'class' => 'btn btn-success btn-lg',
                ],
            ])
            ->add('decline', SubmitType::class, [
                'label' => 'No',
                'attr'  => [
                    'class' => 'btn btn-danger btn-lg',
                ],
            ]);
    }
}
