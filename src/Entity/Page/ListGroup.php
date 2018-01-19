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
    private $template = '<ul class="%s">%s</ul>>';

    /**
     * @var string
     */
    private $cssClass = 'list-group-flush';

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
            implode('</li><li>', $this->getListItems())
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
