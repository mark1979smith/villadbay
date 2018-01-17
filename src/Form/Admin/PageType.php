<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 15/01/2018
 * Time: 21:42
 */

namespace App\Form\Admin;


use App\Form\DataTransformer\TextHeadingType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('page_route', \App\Form\Admin\Types\PageRoute::class, [
                'label'   => 'Please select the page to edit',
                'choices' => [
                    'Please select' => '',
                    'Homepage'      => 'home',
                    'Search'        => 'search',
                    'About'         => 'about',
                    'Contact'       => 'contact',
                ],
                'attr'    => [
                    'aria-describedby' => 'page_route_helper',
                ],
            ])
            ->add('page_type', \App\Form\Admin\Types\PageType::class, [
                'label'   => 'Please select the type of page required',
                'choices' => [
                    'Please select' => '',
                    'Landing page'  => 'landing',
                    'Content page'  => 'content',
                ],
                'attr'    => [
                    'aria-describedby' => 'page_type_helper',
                ],
            ])
            ->add('text_heading_type', CollectionType::class, [
                'entry_type'    => \App\Form\Admin\Types\TextHeadingType::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype'     => true,
                'entry_options' => [
                    'choices'  => [
                        'Heading 1' => 'h1',
                        'Heading 2' => 'h2',
                        'Heading 3' => 'h3',
                        'Heading 4' => 'h4',
                        'Heading 5' => 'h5',
                    ],
                    'label'    => 'Choose a heading type',
                    'required' => false,
                ],
                'attr'          => array(
                    'class' => 'js--text_heading_type col',
                ),
            ])
            ->add('text_heading_css_class', CollectionType::class, [
                'entry_type'    => \App\Form\Admin\Types\TextHeadingClassType::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype'     => true,
                'entry_options' => [
                    'choices'  => [
                        'Display 1' => 'display-1',
                        'Display 2' => 'display-2',
                        'Display 3' => 'display-3',
                        'Display 4' => 'display-4',
                        'Display 5' => 'display-5',
                    ],
                    'label'    => 'Choose a heading style',
                    'required' => false,
                ],
                'attr'          => array(
                    'class' => 'js--text_heading_type col',
                ),
            ])
            ->add('text_heading_text_value', CollectionType::class, [
                'entry_type'    => \App\Form\Admin\Types\TextHeadingTextValueType::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype'     => true,
                'entry_options' => [
                    'label'    => 'Enter text for your heading',
                    'required' => false,
                ],
                'attr'          => array(
                    'class' => 'js--text_heading_type col',
                ),
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Next',
                'attr'  => [
                    'class'     => 'btn-success btn-block',
                    'data-role' => "core",
                ],
            ]);

    }

}
