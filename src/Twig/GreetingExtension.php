<?php

namespace App\Twig;


use App\Security\SocialUser;

/**
 * Class GreetingExtension
 *
 * @package App\Twig
 */
class GreetingExtension extends \Twig_Extension implements \Twig_ExtensionInterface
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('nav_greeting', [$this, 'getNavGreeting'], ['is_safe' => ['html']])
        ];
    }

    /**
     * Get Nav Greeting
     * Note: as this will render out twig markup for the logout link it will need to be rendered out using template_from_string()
     *
     * @param \App\Security\SocialUser|null $user
     *
     * @return string
     */
    public function getNavGreeting(?SocialUser $user)
    {
        if ($user) {
            return <<<HTML
        <span class="navbar-text">
            Welcome {$user->getFirstName()} {$user->getSurname()}! <a href="{{ logout_path() }}">Logout?</a>
            <img src="{$user->getAvatar()}" class="rounded mx-auto" height="24"/>
        </span>
HTML;

        }
    }

}
