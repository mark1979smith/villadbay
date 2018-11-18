<?php
namespace App\Form\Admin\Config\Entry;

use App\Entity\ConfigGroup;
use App\Validator\Constraints\Admin\Config\SlugIsUnique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class CreateType
 *
 * @package App\Form\Admin\Config
 */
class CreateType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('config_groups');

        parent::configureOptions($resolver);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('config_group', ChoiceType::class, [
                'required' => true,
                'choices' => $options['config_groups'],
                'choice_label' => function($configGroup, $key, $value) {
                    /** @var ConfigGroup $configGroup */
                    return $configGroup->getName();
                },
            ])
            ->add('slug', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new SlugIsUnique()
                ]
            ])
            ->add('value', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create new entry',
                'attr'  => [
                    'class' => 'btn btn-success',
                ],
            ]);
    }
}
