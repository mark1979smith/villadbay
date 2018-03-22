<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 02/01/2018
 * Time: 14:51
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('time_of_arrival', TimeType::class, [
                'label' => 'Time of Arrival'
            ])
            ->add('contact_name', TextType::class, [
                'label' => 'Contact Name'
            ])
            ->add('contact_address', TextareaType::class, [
                'label' => 'Billing Address'
            ])
            ->add('contact_number', TelType::class, [
                'label' => 'Contact Number'
            ])
            ->add('alternative_contact_number', TelType::class, [
                'label' => 'Alternative Contact Number',
                'required' => false
            ])
            ->add('fax_number', TelType::class, [
                'label' => 'Fax Number',
                'required' => false
            ])
            ->add('email_address', EmailType::class, [
                'label' => 'E-mail Address'
            ])
            ->add('submit', SubmitType::class, ['label' => 'Submit']);
    }
}
