<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 22/02/2018
 * Time: 12:13
 */

namespace App\Form\Admin;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class DeletePageRevision  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slug', HiddenType::class)
            ->add('delete', SubmitType::class, [
                'label' => 'Delete This Revision?',
                'attr'  => [
                    'class' => 'btn btn-danger',
                ],
            ]);
    }
}
