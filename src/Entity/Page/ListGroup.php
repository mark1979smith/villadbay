<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 20:10
 */

namespace App\Entity\Page;

use Symfony\Component\Validator\Constraints as Assert;

class ListGroup
{
    /** @var string  */
    private $template = '<div class="container"><div class="row"><div class="col"><ul class="%s">%s</ul></div></div></div>';

    /**
     * @var string
     */
    private $cssClass = 'list-group list-group-flush';

    /**
     * @Assert\NotBlank()
     * @var array
     */
    private $listItems = [];

    public function __toString()
    {
        return sprintf(
            $this->getTemplate(),
            $this->getCssClass(),
            '<li class="list-group-item">' . implode('</li><li class="list-group-item">', $this->getListItems()) . '</li>'
        );
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     *
     * @return \App\Entity\Page\ListGroup
     */
    public function setTemplate(string $template): \App\Entity\Page\ListGroup
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return string
     */
    public function getCssClass(): string
    {
        return $this->cssClass;
    }

    /**
     * @param mixed $cssClass
     *
     * @return \App\Entity\Page\ListGroup
     */
    public function setCssClass($cssClass): \App\Entity\Page\ListGroup
    {
        $this->cssClass = $cssClass;

        return $this;
    }

    /**
     * @return array
     */
    public function getListItems(): array
    {
        return $this->listItems;
    }

    /**
     * @param array $listItems
     *
     * @return ListGroup
     */
    public function setListItems(array $listItems): ListGroup
    {
        $this->listItems = $listItems;

        return $this;
    }

}
