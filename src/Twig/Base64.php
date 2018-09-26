<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 02/05/2018
 * Time: 13:15
 */

namespace App\Twig;

class Base64 extends \Twig_Extension implements \Twig_ExtensionInterface
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('base64_encode', 'base64_encode'),
            new \Twig_SimpleFilter('base64_decode', 'base64_decode'),
        );
    }

    public function getName()
    {
        return "base64";
    }
}
