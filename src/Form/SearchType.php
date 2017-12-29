<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 27/12/2017
 * Time: 20:04
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_start', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime',
                'placeholder' => 'Please select a date',
                'label' => 'Check-In',
                'attr' => [
                    'min' => (new \DateTime())->format('Y-m-d'),
                    'max' => (new \DatetIme('+15 years 6 months'))->format('Y-m-d')
                ]
            ])
            ->add('date_end', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime',
                'placeholder' => 'Please select a date',
                'label' => 'Check-Out',
                'attr' => [
                    'min' => (new \DateTime('+1 day'))->format('Y-m-d'),
                    'max' => (new \DatetIme('+16 years'))->format('Y-m-d')
                ]
            ])
            ->add('adult_count', IntegerType::class, [
                'grouping' => true,
                'scale' => 0,
                'rounding_mode' => NumberToLocalizedStringTransformer::ROUND_UP,
                'label' => 'How many Adults?',
                'attr' => [
                    'min' => '1',
                    'max' => '10'
                ],
                'data' => '2'
            ])
            ->add('child_count', IntegerType::class, [
                'grouping' => true,
                'scale' => 0,
                'rounding_mode' => NumberToLocalizedStringTransformer::ROUND_UP,
                'label' => 'How many Children?',
                'attr' => [
                    'min' => '0',
                    'max' => '10'
                ],
                'data' => '0'
            ])
            ->add('search', SubmitType::class, ['label' => 'Search']);
    }
}
