<?php

namespace App\Twig;

/**
 * Class Base64Extension
 *
 * @package App\Twig
 */
class Base64Extension extends \Twig_Extension implements \Twig_ExtensionInterface
{
    public function getFilters(): array
    {
        return array(
            new \Twig_SimpleFilter('base64_encode', 'base64_encode'),
            new \Twig_SimpleFilter('base64_decode', 'base64_decode'),
        );
    }

    public function getName(): string
    {
        return "base64";
    }
}
