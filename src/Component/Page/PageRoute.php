<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 17/01/2018
 * Time: 10:30
 */

namespace App\Component\Page;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class PageRoute
 *
 * @package App\Component\Page
 */
class PageRoute
{
    /**
     * @Assert\NotBlank()
     * @var null|string
     */
    private $pageRoute;

    public function getPageRoute(): ?string
    {
        return $this->pageRoute;
    }

    public function setPageRoute(?string $pageRoute): self
    {
        $this->pageRoute = $pageRoute;

        return $this;
    }

}
