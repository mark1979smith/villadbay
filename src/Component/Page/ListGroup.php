<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 20:10
 */

namespace App\Component\Page;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ListGroup
 *
 * @package App\Component\Page
 */
class ListGroup
{
    use TemplateSetter;

    /** @var string */
    private $template = '<div class="container"><div class="row"><div class="col"><ul class="%s">%s</ul></div></div></div>';

    /**
     * @var string
     */
    private $cssClass = 'list-group list-group-flush';

    /**
     * @Assert\NotBlank()
     */
    private $listItems = [];

    public function __toString(): string
    {
        return sprintf(
            $this->getTemplate(),
            $this->getCssClass(),
            '<li class="list-group-item">' . implode('</li><li class="list-group-item">', $this->getListItems()) . '</li>'
        );
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function getCssClass(): string
    {
        return $this->cssClass;
    }

    public function setCssClass($cssClass): self
    {
        $this->cssClass = $cssClass;

        return $this;
    }

    public function getListItems(): array
    {
        return $this->listItems;
    }

    public function setListItems(array $listItems): self
    {
        $this->listItems = $listItems;

        return $this;
    }

}
