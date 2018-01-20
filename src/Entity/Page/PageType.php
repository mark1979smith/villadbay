<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 19:59
 */

namespace App\Entity\Page;

use Symfony\Component\Validator\Constraints as Assert;

class PageType
{
    /**
     * @Assert\NotBlank()
     * @var string "landing"|"content"
     */
    private $pageType;

    /**
     * @return null|string
     */
    public function getPageType(): ?string
    {
        return $this->pageType;
    }

    /**
     * @param string $pageType
     *
     * @return PageType
     */
    public function setPageType(string $pageType): PageType
    {
        $this->pageType = $pageType;

        return $this;
    }


}
