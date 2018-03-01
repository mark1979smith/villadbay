<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/01/2018
 * Time: 09:46
 */

namespace App\Entity\Page;

/**
 * Class PageImage
 *
 * @package App\Entity\Page
 */
class PageImage
{
    /** @var string */
    private $image;

    /**
     * @return null|string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     *
     * @return PageType
     */
    public function setImage(string $image): PageImage
    {
        $this->image = $image;

        return $this;
    }


}
