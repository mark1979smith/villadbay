<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 17/01/2018
 * Time: 10:30
 */

namespace App\Entity\Page;

use Symfony\Component\Validator\Constraints as Assert;

class PageRoute
{
    /**
     * @Assert\NotBlank()
     * @var null|string
     */
    private $pageRoute;

    /**
     * @return null|string
     */
    public function getPageRoute(): ?string
    {
        return $this->pageRoute;
    }

    /**
     * @param null|string $pageRoute
     *
     * @return PageRoute
     */
    public function setPageRoute(?string $pageRoute): PageRoute
    {
        $this->pageRoute = $pageRoute;

        return $this;
    }

}
