<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/01/2018
 * Time: 09:46
 */

namespace App\Component\Page;

/**
 * Class PageImage
 *
 * @package App\Component\Page
 */
class PageImage
{
    /** @var string */
    private $image;

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): PageImage
    {
        $this->image = $image;

        return $this;
    }


}
