<?php

namespace App\Twig\Admin;


use App\Entity\ConfigGroup;

/**
 * Class ConfigExtension
 *
 * @package App\Twig\Admin
 */
class ConfigExtension extends \Twig_Extension implements \Twig_ExtensionInterface
{
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('nav_groups', [$this, 'getNavGroups'], ['is_safe' => ['html']]),
        ];
    }


    public function getNavGroups(\ArrayIterator $configGroups): string
    {
        $liList = '<li class="list-group-item list-group-item-primary">Groups</li>';
        /** @var ConfigGroup $configGroup */
        foreach ($configGroups as $configGroup)
        {
            $liList .= '<li class="list-group-item"><a href="#config-group-'. $configGroup->getSlug() .'">'. $configGroup->getName() .'</a></li>';
        }

        $html = <<<HTML
        <ul class="list-group" id="config-groups">
           {$liList}
        </ul>
HTML;

        return $html;
    }
}
