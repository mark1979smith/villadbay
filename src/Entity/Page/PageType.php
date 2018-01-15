<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 19:59
 */

namespace App\Entity\Page;


class PageType
{
    /** @var string "landing"|"content" */
    private $pageType;

    /** @var string */
    private $image;

    /**
     * @return string
     */
    public function getPageType(): string
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

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     *
     * @return PageType
     */
    public function setImage(string $image): PageType
    {
        $this->image = $image;

        return $this;
    }


}
