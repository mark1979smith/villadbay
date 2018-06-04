<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 04/06/2018
 * Time: 12:50
 */

namespace App\Form\Admin;


use App\Entity\Carousel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CarouselType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'label'    => 'Name',
            'help'     => 'Must be unique',
            'required' => true,
        ])
            ->add('description', TextareaType::class)
            ->add('send', SubmitType::class, ['label' => 'Create carousel'])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $formEvent) {
                $carousel = $formEvent->getData();

                if ($carousel === null) {
                    return;
                }

                if ($carousel instanceof Carousel) {
                    $carousel->setName(ucfirst(strtolower($carousel->getName())));
                    $formEvent->setData($carousel);
                }
            });
    }
}
