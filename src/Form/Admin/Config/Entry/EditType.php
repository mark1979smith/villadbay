<?php

namespace App\Form\Admin\Config\Entry;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Component\Helpers\Data;

/**
 * Class CreateType
 *
 * @package App\Form\Admin\Config
 */
class EditType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('config_options');

        parent::configureOptions($resolver);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (is_array($options['config_options']) && count($options['config_options'])) {
            $builder->add('value', ChoiceType::class, [
                'choices' => $options['config_options'],
                'choice_value' => function($value) {
                    return Data::getBeforeSubstring($value,':');
                },
                'choice_label' => function($config, $key, $value) {
                    return Data::getAfterSubstring($config, ':');
                },
            ]);
        } else {
            $builder
                ->add('value', TextType::class, [
                    'required'    => true,
                    'constraints' => [
                        new NotBlank(),
                        new Length(['max' => 255])
                    ]
                ]);
        }
        $builder->add('save', SubmitType::class, [
                'label' => 'Save entry',
                'attr'  => [
                    'class' => 'btn btn-success',
                ],
            ]);

    }
}
