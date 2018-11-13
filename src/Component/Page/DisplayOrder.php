<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 17/01/2018
 * Time: 19:54
 */

namespace App\Component\Page;

/**
 * Class DisplayOrder
 *
 * @package App\Component\Page
 */
class DisplayOrder
{
    /**
     * @var int
     */
    private $displayOrder = 0;

    public function getDisplayOrder(): int
    {
        return $this->displayOrder;
    }

    public function setDisplayOrder($displayOrder): self
    {
        $this->displayOrder = $displayOrder;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->displayOrder;
    }
}
