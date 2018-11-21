<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 19:59
 */

namespace App\Component\Page;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class PageType
 *
 * @package App\Component\Page
 */
class PageType
{
    /**
     * @Assert\NotBlank()
     * @var string "landing"|"content"
     */
    private $pageType;

    public function getPageType(): ?string
    {
        return $this->pageType;
    }

    public function setPageType(string $pageType): self
    {
        $this->pageType = $pageType;

        return $this;
    }


}
