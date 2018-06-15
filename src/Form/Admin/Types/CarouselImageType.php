<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 12/06/2018
 * Time: 12:26
 */

namespace App\Form\Admin\Types;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CarouselImageType extends AbstractType
{
    
    public function getParent()
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix()
    {
        return 'CarouselSlideImageType';
    }
}
